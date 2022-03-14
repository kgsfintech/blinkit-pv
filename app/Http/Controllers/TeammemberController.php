<?php

namespace App\Http\Controllers;

use App\Models\Teammember;
use App\Models\Title;
use App\Models\Role;
use Illuminate\Http\Request;
use Image;
use Hash;
use DB;
class TeammemberController extends Controller
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
	 public function changeteamStatus(Request $request)
    { 
      //  dd($request);
        $user = Teammember::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        DB::table('users')->where('teammember_id',$request->user_id)->update([	
            'status'         =>  $request->status,
             ]);
        return response()->json(['success'=>'Status change successfully.']);
    }
    public function index()
    {
		  if(auth()->user()->role_id == 18){
        $teammemberDatas = Teammember::with('title','role')
        ->where('role_id','!=',11)->get();
       // dd($teammemberDatas);
        return view('backEnd.teammember.index',compact('teammemberDatas'));
    }
		else
		{
			        $teammemberDatas = Teammember::with('title','role')
        ->where('role_id','>',auth()->user()->role_id)->get();
       // dd($teammemberDatas);
        return view('backEnd.teammember.index',compact('teammemberDatas'));
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Title::latest()->get();
        $teamrole = Role::where('id','!=','11')->get();
        return view('backEnd.teammember.create',compact('title','teamrole'));
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
                'title_id' => "required",
              'team_member' => "required",
              'role_id' => "required",
           'emailid' => 'required|unique:teammembers',
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
             $data['status'] = 0;
               Teammember::Create($data);
                   $actionName = class_basename($request->route()->getActionname());
                $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                    $id = auth()->user()->teammember_id;
                  DB::table('activitylogs')->insert([
                        'user_id' => $id, 
                        'ip_address' => $request->ip(), 
                        'activitytitle' => $pagename, 
                        'description' => 'New Team Member Added'.' '.'( '. $request->team_member. ' )', 
                        'created_at' => date('y-m-d'),       
                        'updated_at' => date('y-m-d')       
                    ]);
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
     * @param  \App\Models\teammember  $teammember
     * @return \Illuminate\Http\Response
     */
    public function show(teammember $teammember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teammember  $teammember
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title=Title::latest()->get();
        $teamrole=Role::latest()->get();
        $teammember = Teammember::where('id', $id)->first();
        return view('backEnd.teammember.edit', compact('id', 'teammember','title','teamrole'));
    }
 public function resetPassword($id)
    {
       // dd($id);
        $teammember = Teammember::where('id', $id)->first();
        return view('backEnd.teammember.resetpassword', compact('id', 'teammember'));
    }
       public function passwordUpdate(Request $request, $id = '')
    {
        // dd($id);
          $request->validate([
              'emailid' => 'required',
              'password' => 'required',
              'confirm_password' => 'required|same:password',
          ]);
  
          try {
              $date = date("Y-m-d") ;
              $teammemberid =  Teammember::where('id', $id)->select('id')->pluck('id')->first();
           //   dd($teammemberid);
              DB::table('users')->where('teammember_id',$teammemberid)->update([ 
                  'password'         =>  Hash::make($request->password) ,
                  'updated_at'         =>  $date
                  ]);
                    if(auth()->user()->role_id != 11){
                    return redirect('home')->with('alert','Password Updated Successfully!');
          
                }
                else {
                    $output = array('msg' => 'Updated Successfully');
                    return redirect('teammember')->with('success', $output);
                }
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
     * @param  \App\Models\teammember  $teammember
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
            Teammember::find($id)->update($data);
			 DB::table('users')->where('teammember_id',$id)->update([ 
                'role_id'         =>  $request->role_id ,
				 'email'         =>  $request->emailid ,
                ]);
              $actionName = class_basename($request->route()->getActionname());
            $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                $id = auth()->user()->teammember_id;
              DB::table('activitylogs')->insert([
                    'user_id' => $id, 
                    'ip_address' => $request->ip(), 
                    'activitytitle' => $pagename, 
                    'description' => ' Team Member Data Edit'.' '.'( '. $request->team_member. ' )', 
                    'created_at' => date('y-m-d'),       
                    'updated_at' => date('y-m-d')       
                ]);
            $output = array('msg' => 'Updated Successfully');
            return redirect('teammember')->with('success', $output);
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
     * @param  \App\Models\teammember  $teammember
     * @return \Illuminate\Http\Response
     */
    public function destroy(teammember $teammember)
    {
        //
    }
}
