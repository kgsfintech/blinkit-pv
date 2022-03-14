<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Assetregister;
use Image;
class PvformController extends Controller
{
	     public function pvForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'barcode' =>  'required'
            ,
        ]);

   if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;

            return  response()->json($response);
        }
        try {
            
           // $user =DB::table('asset_register')->where('barcode',$request->barcode)->first();
            $asset = DB::table("asset_register")->where('barcode', $request->barcode)->first();

			
            if ($asset) {
                $data = DB::table("stuff_and_store")->where(['staff_id'=> $request->user_id, 'store_code' => $asset->store_code])->get();
                if($asset->photo != null)
                {
                  $asset->photo =url('backEnd/image/asset_register/'.$asset->photo);
                }
                else{
                  $asset->photo = '';
                }
            } else {
                $response['code'] = "404";
                $response['status'] = "false";
                 $response['msg'] = "data not found";
            }
            if (isset($data[0])) {
                $response['output'] = $asset;
                $response['status'] = "true";
                $response['code'] = "100001";
            } else {
                $response['code'] = "404";
               $response['status'] = "false";
                $response['msg'] = "data not found";
            }
          
        } catch (\Exception $e) {
            $response['result'] = "failed";
            $response['msg'] = "Something went wrong ". $e->getMessage();
            $response['code'] = "500";
            Log::info(json_encode(["Error in Member Transaction api-----", $e->getMessage()]));
        }

        return response()->json($response);
    }
      public function pvformUpDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assetregisterid' =>  'required',
			 'a1' =>  'required',
			 'a2' =>  'required',
			 'a3' =>  'required',
			 'a4' =>  'required',
			 'verified_by' =>  'required',
			 'verified_at' =>  'required',
        ]);

        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
            try {
                $data=$request->except(['_token','assetregisterid']);
              if($request->hasFile('photo'))
                {
                              $file=$request->file('photo');
                    $destinationPath = 'backEnd/image/asset_register';
                    //  $name = $file->getClientOriginalName();
                    $name=$request->assetregisterid;
                   $s = $file->move($destinationPath, $name);
                 $data['photo'] = $name;
                }

$id = $request->assetregisterid;
// if($request->hasFile('photo')){
// $data['photo'] = $request->assetregisterid.$data['photo'];
//             }
                  Assetregister::find($id)->update($data);
              $result = DB::table('asset_register')->where('id',$request->assetregisterid)->first();
				  $result->photo =url('backEnd/image/asset_register/'.$result->photo);
				
				     DB::table('pvverifylog')->insert([ 
                'assetregisterid'         =>  $request->assetregisterid,
                'a1'         =>  $request->a1,
                'a2'         =>  $request->a2,
                'a3'         =>  $request->a3,
                'a4'         =>  $request->a4,
                'store_code'         =>  $result->store_code,
             //   'photo'         =>   $data['photo']??'',
                 'verified_by' => $request->verified_by,
                'verified_at'              =>   $request->verified_at,
                ]);
				
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
	 public function assetRegister(Request $request)
                {
                    $validator = Validator::make($request->all(), [
                        'client_id' =>  'required',
                        'store_code' =>  'required',
                        'barcode' =>  'required|unique:asset_register',
                        'asset_name' =>  'required',
                        'asset_type' =>  'required',
                        'qty'        =>  'required',
						 'uploaded_by' =>  'required',
						'updated_at' =>  'required'
                    ]);
            
              
                    if ($validator->fails()) {
                        $response['msg'] = $validator->errors();
                        $response['status'] = 0;
                    
                        return  response()->json($response);
                    }
                        try {
                            $data=$request->except(['_token']);
                         
                          $result=  DB::table('asset_register')->insert([
                                'client_id' => $request->client_id,
                                'uploaded_by' => $request->uploaded_by,
                        'store_code' => $request->store_code,
                        'barcode' => $request->barcode,
                        'asset_name' => $request->asset_name,
                        'asset_type' => $request->asset_type,
                        'qty'        => $request->qty,
                        'updated_at'              =>   $request->updated_at,
                    ]);
            
                       
                          if(is_null($result)){
                         
                            return response()->json(["msg"=>"data not found","code" =>"404","status" =>"false"]);
                                      }
                      else {
                        return response()->json(["msg"=>"Submit successfully","status" =>"true","code" =>"10001"]);
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
