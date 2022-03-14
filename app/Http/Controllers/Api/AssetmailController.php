<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Log;
use DB;
use PDF;
//use App\Models\Teammember;
class AssetmailController extends Controller
{
	
      public function showbyid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_code' =>  'required',
      
        ]);

        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
        

            try {
               
          
          
$store = DB::table('ilrfolders')->where('store_code',$request->store_code)->first();
$result['store'] = DB::table('asset_register')->select('store_code','barcode','asset_name','asset_type','verified_at')->where('store_code',$request->store_code)->where('verified_by','!=',null)->get();
$assets = $result['store'];
$data = array(
'email' =>  $store->email,
'store_code' =>  $store->store_code,
'file' =>    url('backEnd/image/Slide.pdf'),
);

$pdf = PDF::loadView('backEnd.client.assetregisterpdf',array('assets' => $assets));
Mail::send('emails.store', $data, function ($msg) use($data, $pdf){
$msg->to($data['email']);
$msg->subject('Blinkit Store Info');
$msg->attachData($pdf->output(), "store.pdf");
});

    

      $name = $store->store_code."store.pdf";

           $filePath = 'clientinfodocument/' . $name;
             Storage::disk('s3')->put($filePath,$pdf->output());
    

     DB::table('ilranswers')->insert([	
         'questionid'         =>     2, 
         'informationresource_id'         =>     $store->id ??'', 
         'url'         =>                            $store->store_code."store.pdf", 
          'updated_at' => date('Y-m-d H:i:s')     
          ]);
$stores = DB::table('ilranswers')->where('informationresource_id',$store->id)->where('questionid',2)->first();
$result['pdf'] =Storage::disk('s3')->temporaryUrl('clientinfodocument/'.$stores->url, now()->addMinutes(10));
         if(is_null($result)){
                              return response()->json(["msg"=>"data not found","code" =>"404","status" =>"false"]);
                          }
          else {
            return response()->json(["output" => $result,"status" =>"true","code" =>"10001"]);
          }
         

           } catch (\Exception $e) {
               $response['result'] = "failed";
               $response['msg'] = "Something went wrong ". $e->getMessage();
               $response['code'] = "500";
               Log::info(json_encode(["Error in Member Transaction api-----", $e->getMessage()]));
           }
        
           return response()->json($response);
        
            
          }
	 
}
