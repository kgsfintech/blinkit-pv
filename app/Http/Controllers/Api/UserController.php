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
use App\Models\Teammember;
use Image;
class UserController extends Controller
{
	
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

  
        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
            try {
                if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
					 DB::table('users')->where('email', $request->email)->update([          
             	
                'fcm'         => $request->fcm
                ]);
                    $result['userdetail'] = DB::table('users')
            ->leftjoin('teammembers','teammembers.id','users.teammember_id')
            ->leftjoin('roles','roles.id','teammembers.role_id')
            ->where('teammembers.emailid',$request->email)
            ->select('teammembers.*','users.teammember_id','users.fcm','roles.rolename')->first();
				
					$result['store'] = DB::table('stuff_and_store')
						  ->leftjoin('ilrfolders','ilrfolders.store_code','stuff_and_store.store_code')
						->where('stuff_and_store.staff_id',$result['userdetail']->teammember_id)->where('stuff_and_store.staff_id','!=',Null)
						->select('ilrfolders.id','ilrfolders.name','ilrfolders.store_code')->distinct()->get();
					
                    return response()->json(["output" => $result,"status" =>"true","code" =>"10001"]);
         
          }
          else {
            return response()->json(["msg"=>"data not found","code" =>"404","status" =>"false"]);
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
