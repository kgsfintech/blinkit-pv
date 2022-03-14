<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Title;
use App\Models\Role;
use App\Models\User;
use App\Models\Teammember;
use Illuminate\Http\Request;
use Image;
use Hash;
use DB;
use Illuminate\Support\Facades\Mail;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
  {
       
		  if(auth()->user()->role_id == 11){
          $taskDatas = DB::table('tasks')->
      latest()->get();
     //   dd($taskDatas);
        return view('backEnd.task.index',compact('taskDatas'));
    }
    else {
        $taskDatas = DB::table('tasks')
        ->leftjoin('taskassign','taskassign.task_id','tasks.id')
        ->leftjoin('teammembers','teammembers.id','taskassign.teammember_id')
        ->where('taskassign.teammember_id',auth()->user()->teammember_id)
			->orwhere('tasks.createdby',auth()->user()->teammember_id)->select('tasks.*')->get();
     //   dd($taskDatas);
        return view('backEnd.task.index',compact('taskDatas'));
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teammember = Teammember::where('role_id','!=',11)->where('role_id','!=',12)->with('title','role')->get();
        return view('backEnd.task.create',compact('teammember'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
           $request->validate([
                'taskname' => "required",
              'duedate' => "required"
          ]);

            try {

            $id=DB::table('tasks')->insertGetId([	
                'taskname'         =>     $request->taskname, 
               'description'         =>     $request->description, 
               'status'         =>     0, 
               'duedate'         =>     $request->duedate, 	
               'createdby'         =>     auth()->user()->teammember_id, 	
               'created_at'			    =>	   date('y-m-d'),
               'updated_at'              =>    date('y-m-d'),
               ]);
               foreach ($request->teammember_id as $teammember ) 
               {
                DB::table('taskassign')->insert([	
                    'task_id'         =>     $id, 
                   'teammember_id'         =>     $teammember, 	
                   'created_at'			    =>	   date('y-m-d'),
                   'updated_at'              =>    date('y-m-d'),
                   ]);  
               }
                        $teammembers = Teammember::wherein('id',$request->teammember_id)->pluck('emailid')->toArray();
                        foreach ($teammembers as $teammember ) {
               $data = array(
                'taskname' =>  $request->taskname,
                'duedate' =>  $request->duedate,
                'description' =>  $request->description,
    
           );
          
            Mail::send('emails.taskassign', $data, function ($msg) use($data, $teammember){
                $msg->to($teammember);
                $msg->subject('kgs Task Assign');
             });
            }
	
                $output = array('msg' => 'Create Successfully');
                return back()->with('success', $output);
            } catch (Exception $e) {
                DB::rollBack();
                Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                report($e);
                $output = array('msg' => $e->getMessage());
                return back()->withErrors($output)->withInput();
            }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title=Title::latest()->get();
        $teamrole=Role::latest()->get();
        $teammember=Teammember::latest()->get();
        $task = task::where('id', $id)->first();
        return view('backEnd.task.edit', compact('id', 'task','title','teamrole','teammember'));
    }
    public function viewTask($id)
   {
      //  dd($id);
        $task = Task::where('id', $id)->first();
        $taskassign =  DB::table('taskassign')->where('task_id', $id)->get();
        $taskreminderDatas =  DB::table('trail')->where('pageid', $id)->where('pagetitle', 'Task')->get();
       // dd($taskassign);
        $teammember =  DB::table('teammembers')->get();

        return view('backEnd.task.view', compact('id', 'task','teammember','taskassign','taskreminderDatas'));
    }
	   public function taskMail(Request $request)
    {
       // dd($request);
        $request->validate([
             'subject' => "required",
           'email' => "required"
       ]);

         try {
            $task = Task::where('id', $request->taskid)->first();
            foreach ($request->email as $emails) {
                $data = array(
                 'taskname' =>  $task->taskname,
                 'duedate' =>  $task->duedate,
                 'subject' =>  $request->subject,
                 'description' =>  $task->description,
                 'msg' =>  $request->msg,
                 'email' =>  $emails,
     
            );
           
             Mail::send('emails.taskremindermail', $data, function ($msg) use($data){
                 $msg->to($data['email']);
                 $msg->subject($data['subject']);
              });
             }

				  $taskid = $request->taskid;
      //    dd($value);
            $task = 'Task Reminder Send ';
             $this->activityLog($request, $taskid, $task);
             $output = array('msg' => 'Mail Send Successfully');
             return back()->with('success', $output);
         } catch (Exception $e) {
             DB::rollBack();
             Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
             report($e);
             $output = array('msg' => $e->getMessage());
             return back()->withErrors($output)->withInput();
         }
     
 }
 public function activityLog($request, $taskid,$task){
    $actionName = class_basename($request->route()->getActionname());
            $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
              DB::table('trail')->insert([
                    'createdby' => auth()->user()->teammember_id, 
                    'ip_address' => $request->ip(), 
                    'pagetitle' => $pagename, 
                    'pageid' => $taskid, 
                    'type' => 'Task', 
                    'description' => $task, 
                    'created_at' => date('y-m-d H:i:s'),       
                    'updated_at' => date('y-m-d H:i:s')       
                ]);
  }
 public function resetPassword($id)
    {
       // dd($id);
        $task = task::where('id', $id)->first();
        return view('backEnd.task.resetpassword', compact('id', 'task'));
    }
       public function taskComplete(Request $request)
    {
        // dd($id);
          $request->validate([
              'status' => 'required',
              'remark' => 'required'
          ]);
  
          try {
              $date = date("Y-m-d") ;
             
              DB::table('tasks')->where('id',$request->rid)->update([ 
                  'status'         =>  $request->status ,
                  'remark'         =>  $request->remark ,
                  'updated_at'         =>  $date
                  ]);
                  $output = array('msg' => 'Updated Successfully');
                  return redirect('task')->with('success', $output);
          } catch (Exception $e) {
              DB::rollBack();
              Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
              report($e);
              $output = array('msg' => $e->getMessage());
              return back()->withErrors($output)->withInput();
          }
      }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
       //     'mobile_no' => "required|numeric",
       //     'pancardno' => "required|numeric",
            'team_member' => "required"
        ]);
        try {
            $data=$request->except(['_token']);
            if($request->hasFile('profilepic'))
            {
                $avatar = $request->file('profilepic');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('backEnd/image/task/profilepic/' . $filename);
                $data['profilepic']=$filename;
            }
            if($request->hasFile('panupload'))
            {
                $avatar = $request->file('panupload');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('backEnd/image/task/panupload/' . $filename);
                $data['panupload']=$filename;
            }
            if($request->hasFile('addressupload'))
            {
                $avatar = $request->file('addressupload');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('backEnd/image/task/addressupload/' . $filename);
                $data['addressupload']=$filename;
            }
            task::find($id)->update($data);
              $actionName = class_basename($request->route()->getActionname());
            $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                $id = auth()->user()->task_id;
              DB::table('activitylogs')->insert([
                    'user_id' => $id, 
                    'ip_address' => $request->ip(), 
                    'activitytitle' => $pagename, 
                    'description' => ' Team Member Data Edit'.' '.'( '. $request->team_member. ' )', 
                    'created_at' => date('y-m-d'),       
                    'updated_at' => date('y-m-d')       
                ]);
            $output = array('msg' => 'Updated Successfully');
            return redirect('task')->with('success', $output);
    } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
      //  dd($id);
        try {
            Task::destroy($id);
            $output = array('msg' => 'Deleted Successfully');
            return redirect('task')->with('statuss', $output);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
}
