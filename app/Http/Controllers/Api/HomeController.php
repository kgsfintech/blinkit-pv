<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Assignmentmapping;
use App\Models\Teammember;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use Log;
use DB;
class HomeController extends Controller
{
  
    public function homeList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roleid' => 'required',
        ]);

  
        if ($validator->fails()) {
            $response['msg'] = $validator->errors();
            $response['status'] = 0;
        
            return  response()->json($response);
        }
            try { 
                if ($request->roleid == 13) {
                    $result['assignmentpartnercount'] = DB::table('assignmentmappings')
              ->leftjoin('assignmentbudgetings','assignmentbudgetings.assignmentgenerate_id','assignmentmappings.assignmentgenerate_id')
              ->leftjoin('clients','clients.id','assignmentbudgetings.client_id')
              ->leftjoin('assignments','assignments.id','assignmentbudgetings.assignment_id')
              ->leftjoin('assignmentteammappings','assignmentteammappings.assignmentmapping_id','assignmentmappings.id')
               
              ->select('assignmentbudgetings.client_id','assignmentbudgetings.assignmentgenerate_id'
              ,'clients.client_name','assignments.assignment_name')
         ->where('assignmentmappings.leadpartner',$request->teammemberid)->distinct()->get()->count();
         $result['notificationpartnercount'] = 0;
         $result['task'] =  DB::table('tasks')
			     ->leftjoin('teammembers AS A', 'A.id', '=', 'tasks.teammember_id')
         ->leftjoin('teammembers AS B', 'B.id', '=', 'tasks.createdby')
         ->leftjoin('roles','roles.id','A.role_id')
         ->where('createdby',$request->teammemberid)
         ->orwhere('teammember_id',$request->teammemberid)->
         select('tasks.taskname','tasks.created_at','tasks.attachment','tasks.status','tasks.description','tasks.id','tasks.duedate','B.team_member as createdby','A.team_member as team_member','roles.rolename')->get();
					     foreach($result['task'] as $res)
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
                    $res->status = "received";
                  }
             
              }
         $result['asset'] = DB::table('assets')
              ->leftjoin('financerequests','financerequests.id','assets.financerequest_id')->
              where('assets.teammember_id',$request->teammemberid)
              ->select('financerequests.modal_name','financerequests.sno','financerequests.assetstatus',
              'financerequests.description','financerequests.kgs','assets.id')->get();
                }
                elseif ($request->roleid == 11 || $request->roleid == 12) {
                    $result['assignmentadmincount'] =  Assignmentmapping::count();
                    $result['clientadmincount'] =  Client::count();
                    $result['teammemberadmincount'] = Teammember::where('status','1')->where('role_id','!=','11')->count();
                    $result['notificationadmincount'] = 0;
                    $result['task'] =  DB::table('tasks')
                      ->leftjoin('teammembers AS A', 'A.id', '=', 'tasks.teammember_id')
         ->leftjoin('teammembers AS B', 'B.id', '=', 'tasks.createdby')
         ->leftjoin('roles','roles.id','A.role_id')->
                    select('tasks.taskname','tasks.created_at','tasks.description','tasks.attachment','tasks.status','tasks.id','tasks.duedate','B.team_member as createdby','A.team_member as team_member','roles.rolename')->get();
					   foreach($result['task'] as $res)
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
                    $res->status = "received";
                  }
             
              }
                       $result['asset'] = DB::table('assets')
              ->leftjoin('financerequests','financerequests.id','assets.financerequest_id')->
              where('assets.teammember_id',$request->teammemberid)
              ->select('financerequests.modal_name','financerequests.sno','financerequests.assetstatus',
              'financerequests.description','financerequests.kgs','assets.id')->get();
                }
                else {
                    $result['assignmentstaffcount'] =  DB::table('assignmentmappings')
                    ->leftjoin('assignments','assignments.id','assignmentmappings.assignment_id')
                   ->leftjoin('assignmentbudgetings','assignmentbudgetings.assignmentgenerate_id','assignmentmappings.assignmentgenerate_id')
                   ->leftjoin('clients','clients.id','assignmentbudgetings.client_id')
                   ->leftjoin('assignmentteammappings','assignmentteammappings.assignmentmapping_id','assignmentmappings.id')
                   ->select('assignmentmappings.*','clients.client_name',
                    'assignments.assignment_name')->where('assignmentteammappings.teammember_id',$request->teammemberid)->get()->count();
                    $result['notificationstaffcount'] = 0;
                    $result['task'] =  DB::table('tasks')
                     ->leftjoin('teammembers AS A', 'A.id', '=', 'tasks.teammember_id')
         ->leftjoin('teammembers AS B', 'B.id', '=', 'tasks.createdby')
         ->leftjoin('roles','roles.id','A.role_id')
                    ->where('createdby',$request->teammemberid)
                    ->orwhere('teammember_id',$request->teammemberid)->
                    select('tasks.taskname','tasks.created_at','tasks.description','tasks.attachment','tasks.status','tasks.id','tasks.duedate','B.team_member as createdby','A.team_member as team_member','roles.rolename')->get();
										   foreach($result['task'] as $res)
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
                    $res->status = "received";
                  }
             
              }
                       $result['asset'] = DB::table('assets')
              ->leftjoin('financerequests','financerequests.id','assets.financerequest_id')->
              where('assets.teammember_id',$request->teammemberid)
              ->select('financerequests.modal_name','financerequests.sno','financerequests.assetstatus',
              'financerequests.description','financerequests.kgs','assets.id')->get();
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
