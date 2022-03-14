<?php

namespace App\Http\Controllers;
use App\Models\Target;
use Illuminate\Http\Request;
use DB;
class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware('auth')->except(['showtargetForm', 'login']);
    }
	  public function showtargetForm()
    {
        return view('target');
    }
    public function login(Request $request)
    { 
        $request->validate([
           'startup_name' => "required",
            'category' => "required",
     'email' => "required|unique:targets",
        ]);

       try {
          
           $data=$request->except(['_token']);
           if($request->hasFile('deck'))
           {
               $avatar = $request->file('deck');
               $filename = time() . '.' . $avatar->getClientOriginalExtension();
               Image::make($avatar)->resize(700, 700)->save('backEnd/image/deck/' . $filename);
               $data['deck']=$filename;
           }
           Target::Create($data);
         // dd($data);
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
    public function index()
  {
       
		  
          $targetDatas = DB::table('targets')->
      latest()->get();
        //dd($taskDatas);
        return view('backEnd.target.index',compact('targetDatas'));
    } 
    public function viewTarget($id)
    {
       //  dd($id);
         $target = DB::table('targets')->where('id', $id)->first();
        
 
         return view('backEnd.target.view', compact('id', 'target'));
     }
    /**
     * Show the form for creating a new resource.
     *
     */

}

