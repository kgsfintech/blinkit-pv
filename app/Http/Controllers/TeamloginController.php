<?php

namespace App\Http\Controllers;

use App\Models\Teammember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
class TeamloginController extends Controller
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
    //     $teammemberDatas = Teammember::with('title','teamlevel')->latest()->get();
    //    // dd($teammemberDatas);
    //     return view('backEnd.teammember.index',compact('teammemberDatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teammemberlist = Teammember::where('status','0')->get();
     //   dd($teammemberlist);
        return view('backEnd.teamlogin.create',compact('teammemberlist'));
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
            $request->validate([
                'password' => "required"
            ]);

            try  {
                $memberid=Teammember::where('emailid',$request->teammember_id)->select('id','role_id')->first();
              // dd($memberid->id);
                $data=$request->except(['_token']);
                $data['password']=  Hash::make($request->password);
                $data['email']=$request->email;
                 $data['teammember_id']= $memberid->id;
                 $data['role_id']= $memberid->role_id;
                $data['status']=1;
                $data = User::Create($data);
                DB::table('teammembers')->where('id',$memberid->id)->update([	
                    'status'         =>     '1', 
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
    public function findlogin(Request $request){


        $p=Teammember::select('email')->where('registred_company_name',$request->aircraft_id)->first();
    
        return response()->json($p);
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
