<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Teammember;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use Log;
use DB;
class TaskController extends Controller
{
   
    public function insertTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teammemberid' => 'required',
            'taskname' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'createdby' => 'required',
        ]);

  
        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
            try {
				   if($request->hasFile('attachment'))
            {
                $file=$request->file('attachment');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('backEnd/image/task/',$filename);
                $data['attachment']=$filename;
            }
              $result =  DB::table('tasks')->insert([
                    'teammember_id'   	=>     $request->teammemberid,
                    'taskname'   	=>     $request->taskname,
                    'description'   	=>     $request->description,
                    'duedate'   	=>     $request->duedate,
				       'attachment' => $data['attachment'] ??'', 
                    'createdby'   	=>     $request->createdby,
                    'status'   	=>     0,
                    'created_at'			    =>	   date('y-m-d'),
                    'updated_at'              =>    date('y-m-d'),
                ]);
              //    $teammember = Teammember::where('id',$request->teammemberid)->pluck('emailid')->first(); 
              //   dd($teammember);
             //   $data = array(
               //  'taskname' =>  $request->taskname,
             //    'duedate' =>  $request->duedate,
               //  'description' =>  $request->description,
     
        //    );
           
          //   Mail::send('emails.taskassign', $data, function ($msg) use($data, $teammember){
            //     $msg->to($teammember);
              //   $msg->subject('kgs Task Assign');
            //  });
				 $user=User::select('fcm')->where('teammember_id',$request->teammemberid)->get();
             $this->sendGCMBulk($user, $request->taskname,'','', 'notification');
                          if(is_null($result)){
                              return response()->json(["msg"=>"data not found","code" =>"404","status" =>"false"]);
                          }
          else {
            return response()->json(["msg"=>"insert successfully","status" =>"true","code" =>"10001"]);
          }
         

           } catch (\Exception $e) {
               $response['result'] = "failed";
               $response['msg'] = "Something went wrong ". $e->getMessage();
               $response['code'] = "500";
               Log::info(json_encode(["Error in Member Transaction api-----", $e->getMessage()]));
           }
        
           return response()->json($response);
        
            
          }
	public function taskComplete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'taskid' => 'required',
            'status' => 'required',
        ]);

  
        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
            try {
                
              DB::table('tasks')->where('id',$request->taskid)->update([ 
                  'status'         =>  $request->status ,
                  'remark'         =>  $request->remark ,
                  'updated_at'         =>  date("Y-m-d") 
                  ]);
                  $result =  DB::table('tasks')
                  ->leftjoin('teammembers','teammembers.id','tasks.teammember_id')
                  ->leftjoin('roles','roles.id','teammembers.role_id')
                  ->where('tasks.id',$request->taskid)->
                 select('tasks.taskname','tasks.attachment','tasks.status','tasks.description','tasks.duedate','tasks.remark','teammembers.team_member','roles.rolename')->get();
            //   dd($result);
            foreach($result as $res)
                    {
                      if($res->attachment == null)
                      {
                        
                        $res->attachment = null; 
                      }
                      else {
                        $res->attachment = url('backEnd/image/task/'.$res->attachment);
                      }
                      if($res->status == 0)
                      {
                        $res->status = "pending";
                      }
                      else {
                        $res->status = "completed";
                      }
                 
                  }
                  if($result->isEmpty()){
             
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
    public function taskList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teammemberid' => 'required',
        ]);

  
        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
            try {
              $result =  DB::table('tasks')
              ->leftjoin('teammembers','teammembers.id','tasks.teammember_id')
              ->leftjoin('roles','roles.id','teammembers.role_id')
              ->where('createdby',$request->teammemberid)
              ->orwhere('teammember_id',$request->teammemberid)->
             select('tasks.taskname','tasks.attachment','tasks.status','tasks.description','tasks.duedate','tasks.remark','teammembers.team_member','roles.rolename')->get();
        //   dd($result);
        foreach($result as $res)
                {
                  if($res->attachment == null)
                  {
                    
                    $res->attachment = null; 
                  }
                  else {
                    $res->attachment = url('backEnd/image/task/'.$res->attachment);
                  }
                  if($res->status == 0)
                  {
                    $res->status = "pending";
                  }
                  else {
                    $res->status = "completed";
                  }
             
              }
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
