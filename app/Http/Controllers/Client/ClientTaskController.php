<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Ilrfolder;
use App\Models\Clientlogin;
use App\Models\Teammember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use DB;
use Illuminate\Support\Facades\Hash;

class ClientTaskController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:clientlogin');
    }
    public function index()
  {
        $taskDatasquestion = DB::table('tasks')
        ->leftjoin('taskassign','taskassign.task_id','tasks.id')
        ->leftjoin('clienttask','clienttask.task_id','tasks.id')
        ->join('informationresources','informationresources.id','clienttask.question_id')
        ->where('taskassign.teammember_id',auth()->user()->id)
        ->where('tasks.client_id',auth()->user()->client_id)
			->orwhere('tasks.createdby',auth()->user()->id)
        ->select('tasks.*','informationresources.question')->get();
     //  dd($taskDatasquestion);
        $taskDatasfolder = DB::table('tasks')
        ->leftjoin('taskassign','taskassign.task_id','tasks.id')
        ->leftjoin('clienttask','clienttask.task_id','tasks.id')
        ->leftjoin('informationresources','informationresources.id','clienttask.question_id')
        ->join('ilrfolders','ilrfolders.id','clienttask.folder_id')
        ->where('taskassign.teammember_id',auth()->user()->id)
        ->where('tasks.client_id',auth()->user()->client_id)
					->orwhere('tasks.createdby',auth()->user()->id)
        ->select('tasks.*','ilrfolders.name')->get();
       //dd($taskDatas);
        return view('client.task.index',compact('taskDatasfolder','taskDatasquestion'));
    
    }
    public function taskUpdate(Request $request)
    {
        try {
            DB::table('tasktrails')->insert([
                'task_id' => $request->task_id, 
                 'remark' => $request->remark, 
                'status' => $request->status,
                'createdby' =>  auth()->user()->id, 
                'client_id' => auth()->user()->client_id, 
                 'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')               
            ]); 
            
            DB::table('tasks')->where('id',$request->task_id)->update([	
                'status' => $request->status   
                 ]);
            $output = array('msg' => 'Submit Successfully');
             return back()->with('success', $output);
         } catch (Exception $e) {
             DB::rollBack();
             Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
             report($e);
             $output = array('msg' => $e->getMessage());
             return back()->withErrors($output)->withInput();
         }
    }
    public function viewTask($id)
    {
       
         $viewinfo = DB::table('tasks')
         ->leftjoin('taskassign','taskassign.task_id','tasks.id')
        ->leftjoin('clienttask','clienttask.task_id','tasks.id')
        ->join('informationresources','informationresources.id','clienttask.question_id')
         ->where('tasks.id',$id)->select('tasks.*','informationresources.question')->first();
       // dd($viewinfo);
        $tasktrails = DB::table('tasktrails')
         ->leftjoin('clientlogins','clientlogins.id','tasktrails.createdby')
         ->where('tasktrails.task_id',$id)
         ->where('tasktrails.client_id',auth()->user()->client_id)->orderBy('created_at', 'asc')->select('tasktrails.*',
         'clientlogins.name')->get();
         return view('client.task.view',compact('id','viewinfo','tasktrails'));
     
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teammember = Teammember::where('role_id','!=',11)->where('role_id','!=',12)->with('title','role')->get();
        return view('client.task.create',compact('teammember'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        //dd($request);
           $request->validate([
                'taskname' => "required",
              'duedate' => "required"
          ]);

            try {

            $id=DB::table('tasks')->insertGetId([	
                'taskname'         =>     $request->taskname, 
               'description'         =>     $request->description, 
               'status'         =>     0, 
               'priority'         =>     $request->priority, 
               'duedate'         =>     $request->duedate, 	
               'createdby'         =>     auth()->user()->id, 	
               'client_id'         =>     auth()->user()->client_id, 	
               'created_at'			    =>	   date('Y-m-d H:i:s'),
               'updated_at'              =>    date('Y-m-d H:i:s'),
               ]);
               foreach ($request->teammember_id as $teammember ) 
               {
                DB::table('taskassign')->insert([	
                    'task_id'         =>     $id, 
                   'teammember_id'         =>     $teammember, 	
                   'created_at'			    =>	   date('Y-m-d H:i:s'),
                   'updated_at'              =>    date('Y-m-d H:i:s'),
                   ]);  
               }
               if($request->has('question'))
               {
                foreach ($request->question as $question ) 
                {
                 DB::table('clienttask')->insert([	
                     'task_id'         =>     $id, 
                    'question_id'         =>     $question, 	
                   
                    ]);  
                }
                  
               }
               if($request->has('folder_id'))
               {
                foreach ($request->folder_id as $folder ) 
                {
                 DB::table('clienttask')->insert([	
                     'task_id'         =>     $id, 
                    'folder_id'         =>     $folder, 	
                   
                    ]);  
                }
                  
               }
               if($request->has('subfolder_id'))
               {
                foreach ($request->subfolder_id as $subfolder ) 
                {
                 DB::table('clienttask')->insert([	
                     'task_id'         =>     $id, 
                    'subfolder_id'         =>     $subfolder, 	
                   
                    ]);  
                }
                  
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
	
                $output = array('msg' => 'Task Create Successfully');
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
        return view('client.task.edit', compact('id', 'task','title','teamrole','teammember'));
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
        return view('client.task.resetpassword', compact('id', 'task'));
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
                Image::make($avatar)->resize(800, 600)->save('client/image/task/profilepic/' . $filename);
                $data['profilepic']=$filename;
            }
            if($request->hasFile('panupload'))
            {
                $avatar = $request->file('panupload');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('client/image/task/panupload/' . $filename);
                $data['panupload']=$filename;
            }
            if($request->hasFile('addressupload'))
            {
                $avatar = $request->file('addressupload');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('client/image/task/addressupload/' . $filename);
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
                    'created_at' => date('Y-m-d H:i:s'),       
                    'updated_at' => date('Y-m-d H:i:s')       
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