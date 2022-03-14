<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Tender;
use App\Models\Training;
use App\Models\Asset;
use App\Models\Page;
use App\Models\Assetticket;
use App\Models\Title;
use App\Models\Teammember;
use App\Models\Assignment;
use App\Models\Assignmentteammapping;
use App\Models\Assignmentmapping;
use App\Models\Notification;
use App\Models\Client;
use App\Models\Permission;
use DB;
class BackEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 public function create()
    {
      $pages = DB::table('pages')->where('id','!=','3')->where('id','!=','9')->get();
       return view('backEnd.training.create',compact('pages'));
    }
		  public function trainingreminderMail()
    {
			  
   $trainingid = Training::pluck('teammember_id')->toArray();
   
      $accountant = Teammember::whereNotIn('id',$trainingid)->where('id','!=','6')->where('id','!=','156')->pluck('emailid')->toArray();
  // dd($accountant);
      foreach ($accountant as $accountantmail ) {
          $teammember = $accountantmail;
          $data = array(
       
          );
         
           Mail::send('emails.trainingreminder', $data, function ($msg) use($data, $teammember){
               $msg->to($teammember);
               $msg->subject('kgs Training Reminder');
            });
           
           // die;
          }
          $output = array('msg' => 'Reminder Mail Send Successfully');
          return redirect('traininglist')->with('success', $output);
      }
	public function trainingMail(Request $request)
    {
      $module = Page::wherein('id',$request->module)->get();
     // dd($module);
      $teammember = DB::table('teammembers')->where('id',$request->id)->pluck('emailid')->first();
      $data = array(
        'module' =>  $module,
   );
  
    Mail::send('emails.trainingmail', $data, function ($msg) use($data, $teammember){
        $msg->to($teammember);
        $msg->subject('kgs Training Reminder');
     });
     $output = array('msg' => 'Reminder Mail Send Successfully');
     return redirect('traininglist')->with('success', $output);
     
    }
		  public function training(Request $request)
{ 
 // dd($request);
    try {
      $trainingid=	DB::table('trainings')->insertGetId([			
        'teammember_id'         => auth()->user()->teammember_id,
        'created_at'			    =>	   date('y-m-d'),
        'updated_at'              =>    date('y-m-d'),
        ]);

        foreach($request->page_id as $page_id){
      //   dd($page_id);
            DB::table('traininglists')->insert([
                        'training_id'   	=>     $trainingid,
                        'page_id'     =>     $page_id,
                        'understood'     =>     1,
                        'created_at'			    =>	   date('y-m-d'),
                        'updated_at'              =>    date('y-m-d'),
                    ]);
        }
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
	 public function traininglist()
    {
		   if(auth()->user()->role_id == 17 || auth()->user()->role_id == 11 ){
        $trainingDatas = DB::table('trainings')
        ->leftjoin('teammembers','teammembers.id','trainings.teammember_id')
        ->leftjoin('roles','roles.id','teammembers.role_id')
        ->select('trainings.*','teammembers.team_member','roles.rolename')->where('teammember_id','!=', '6')->get();
        return view('backEnd.training.index',compact('trainingDatas'));
		   }
		 else
		 {
			  $trainingDatas = DB::table('trainings')
        ->leftjoin('teammembers','teammembers.id','trainings.teammember_id')
        ->leftjoin('roles','roles.id','teammembers.role_id')
        ->select('trainings.*','teammembers.team_member','roles.rolename')->where('teammember_id',auth()->user()->teammember_id)->get();
        return view('backEnd.training.index',compact('trainingDatas'));
		 }
    }
	public function traininglistshow($id = '')
    {
      $pages = DB::table('pages')->where('id','!=','3')->where('id','!=','9')->get();
        $trainingDatas = DB::table('traininglists')->where('training_id',$id)->get();
      $training = DB::table('trainings')->where('id',$id)->first();
        return view('backEnd.training.edit',compact('trainingDatas','pages','training'));
     
    }
   public function index()
    {
	
  if(auth()->user()->role_id == 11)
  {
	     $clientDatas = Client::select('client_name','id')->distinct()->get();
          //  dd($clientDatas);
            return view('backEnd.client.folderwise',compact('clientDatas'));
  }
 elseif(auth()->user()->role_id == 15)
{
    $clientDatas =     DB::table('clients')
   ->leftjoin('staffassigns','staffassigns.client_id','clients.id')
  ->where('staffassigns.staff_id',auth()->user()->teammember_id)
   ->select('clients.*')->distinct()->get();
    //dd($clientDatas);
    return view('backEnd.client.folderwise',compact('clientDatas'));
}
    }
    public function ticketIndex($id)
    {
        $ticket =  DB::table('assets')
        ->leftjoin('financerequests','financerequests.id','assets.financerequest_id')->
        where('assets.id',$id)->select('assets.id','financerequests.modal_name','financerequests.sno','financerequests.kgs'
        ,'financerequests.description')->first();
        
        return view('backEnd.generateticket',compact('id','ticket'));
    }
    public function userProfile($id)
    {
        $userid = auth()->user()->id;
        $teammemberid = User::where('id',$userid)->pluck('teammember_id')->first();
       // dd($userid);
       $asset = Asset::where('teammember_id',$teammemberid)->first();
        $title=Title::latest()->get();
        $userInfo = Teammember::where('id',$teammemberid)->first();
      $assetticket = Assetticket::where('created_by',$userid)->get();
		   $teamprofile = DB::table('teamprofiles')->where('teammember_id',auth()->user()->teammember_id)->first();
        return view('backEnd.userprofile' ,compact('userInfo','title','asset','assetticket','teamprofile'));
    }
    public function update(Request $request)
    {
     
        $request->validate([
            'team_member' => "required",
            'mobile_no' => "required|numeric",
          
            'team_member' => "required"
        ]);
        try {
            $data=$request->except(['_token']);
            if($request->hasFile('profilepic'))
            {
                $avatar = $request->file('profilepic');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('backEnd/image/teammember/profilepic/' . $filename);
                $data['profilepic']=$filename;
            }
            if($request->hasFile('panupload'))
            {
                $avatar = $request->file('panupload');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('backEnd/image/teammember/panupload/' . $filename);
                $data['panupload']=$filename;
            }
            if($request->hasFile('addressupload'))
            {
                $avatar = $request->file('addressupload');
                $filename = time().rand(1,100).'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(800, 600)->save('backEnd/image/teammember/addressupload/' . $filename);
                $data['addressupload']=$filename;
            }
              $ids = $request->id;
        //       $teammemberid = User::where('id',$ids)->pluck('teammember_id')->first();
        //    //   dd($teammemberid);
            Teammember::find($ids)->update($data);
            $output = array('msg' => 'Updated Successfully');
            return back()->with('success', $output);
    } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
     public function activityLog()
    {
        $activitylogDatas = DB::table('activitylogs')
        ->leftjoin('teammembers','teammembers.id','activitylogs.user_id')
        ->leftjoin('roles','roles.id','teammembers.role_id')
        ->select('activitylogs.*','teammembers.team_member','roles.rolename')->get();

        return view('backEnd.activitylog.index',compact('activitylogDatas'));
     
    }
	 public function userLog()
    {
        $userlogDatas = DB::table('userloginactiviteies')
        ->leftjoin('teammembers','teammembers.id','userloginactiviteies.teammember_id')
        ->leftjoin('roles','roles.id','teammembers.role_id')->where('teammember_id','!=','6')
        ->select('userloginactiviteies.*','teammembers.team_member','roles.rolename')->get();

        return view('backEnd.userloginlog.index',compact('userlogDatas'));
     
    }
}
