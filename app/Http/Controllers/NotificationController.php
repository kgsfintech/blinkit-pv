<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Teammember;
use DB;
class NotificationController extends Controller
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
            $notificationDatas = Notification::latest()->get();
            return view('backEnd.notification.index',compact('notificationDatas'));
        }
        elseif(auth()->user()->role_id == 13)
        {
              $notificationDatas = DB::table('notifications')
              ->leftjoin('teammembers','teammembers.id','notifications.created_by')
            ->leftjoin('notificationtargets','notificationtargets.notification_id','notifications.id')
            ->Where('targettype','3')->orWhere('targettype','2')
            ->orwhere('notificationtargets.teammember_id',auth()->user()->teammember_id )->get();
            return view('backEnd.notification.index',compact('notificationDatas'));
        }
        else{
          //  $notificationDatas = Notification::Where('targettype','1')->orWhere('targettype','2')->get();
          $notificationDatas =  DB::table('notifications')
          ->leftjoin('teammembers','teammembers.id','notifications.created_by')
          ->leftjoin('notificationtargets','notificationtargets.notification_id','notifications.id')
          ->where('notifications.targettype','2')
          ->orwhere('notificationtargets.teammember_id',auth()->user()->teammember_id )
            ->select('notifications.*','teammembers.team_member','teammembers.profilepic')->get();
            return view('backEnd.notification.index',compact('notificationDatas'));
        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teammember = Teammember::Where('role_id','!=','12')
        ->where('role_id','>',auth()->user()->role_id)->with('role')->get();
        return view('backEnd.notification.create', compact('teammember'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         // $request->validate([
         //     'title' => "required",
         //     'team_member' => "required"
         // ]);
 
         try {
               $authid = auth()->user()->teammember_id;
             $data=$request->except(['_token']);
             $notification_id=	DB::table('notifications')->insertGetId([			
                 'title'         => $request->title,
                  'created_by'  => $authid,
                 'targettype'         => $request->targettype,
                 'created_at'			    =>	   date('Y-m-d H:i:s'),
                 'updated_at'              =>    date('Y-m-d H:i:s'),
                 ]);
                 if($request->targettype == 1){
                 foreach($request->teammember_id as $teammember_id){
                     DB::table('notificationtargets')->insert([
                                 'notification_id'   	=>     $notification_id,
                                 'teammember_id'     =>     $teammember_id,
                                 'created_at'			    =>	   date('y-m-d'),
                                 'updated_at'              =>    date('y-m-d'),
                             ]);
                 }
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
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
