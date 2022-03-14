<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Log;
use DB;
//use App\Models\Teammember;
class AssetregisterController extends Controller
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
               
              $result['store1'] = DB::table('asset_register')->where('store_code',$request->store_code)->get();
              $result['store2'] = DB::table('asset_register')->where('store_code',$request->store_code)->where('verified_at', null)->get();
              $result['store3'] = DB::table('asset_register')->where('store_code',$request->store_code)->whereNotNull('verified_at')->get();

            //  $result['store']->photo =url('backEnd/image/asset_register/'.$result['store']->photo);
				

				
              $result['pvverifylog'] = DB::table('pvverifylog')->where('store_code',$request->store_code)->get();
            

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
          public function showbyid2(Request $request)
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
                     
                    $result['store'] = DB::table('asset_register')->where('store_code',$request->store_code)->where('verified_at', null)->get();
                  //  $result['store']->photo =url('backEnd/image/asset_register/'.$result['store']->photo);
              
      
              
                    $result['pvverifylog'] = DB::table('pvverifylog')->where('store_code',$request->store_code)->get();
                  
      
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
