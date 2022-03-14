<?php

namespace App\Http\Controllers;
use App\imports\Informationresourceimport;
use App\Models\Informationresource;
use Illuminate\Http\Request;
use App\Models\Ilrfolder;
use App\Models\Ilranswer;
use Illuminate\Support\Facades\Redirect;
use DB;
use Crypt;
use Excel;
class InformationresourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		public function editQuestion(Request $request )
    {
     $request->validate([
         'question' => 'required'
     ]);
   
     try {
        DB::table('informationresources')->where('id',$request->id)->update([ 
            'question'         =>  $request->question 
            ]);
          
        $output = array('msg' => 'question update Successfully');
         return back()->with('success', $output);
     } catch (Exception $e) {
         DB::rollBack();
         Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
         report($e);
         $output = array('msg' => $e->getMessage());
         return back()->withErrors($output)->withInput();
     }
 }
	  public function editrecords(Request $request)
    {
      //  dd($request);
        if ($request->ajax()) {
            if (isset($request->id)) {
                $ilrquestion = Informationresource::where('id',$request->id)->first();
           //  dd($ilrquestion);
                return response()->json($ilrquestion);
             }
            }
    
    }
	
	    public function informationDelete($id)
    {
      //  dd($id);
        $ilranswer = Ilranswer::find($id);
        $ilranswer->delete();
        $output = array('msg' => 'Deleted Successfully');
        return back()->with('success', $output);
        
    }
	 public function assignfolderStore(Request $request)
    
    { 
                  try {
           
            $count=count($request->assign);
            
                 for($i=0;$i<$count;$i++){
                    $countt=count($request->folderid);
                    for($j=0;$j<$countt;$j++){
                    DB::table('ilrfolderassigns')->insert([
                        'clientlogin_id'         =>     $request->assign[$i], 	
                        'ilrfolder_id'         =>     $request->folderid[$j], 
                        'client_id'         =>     $request->client_id, 
                       'created_at'			    =>	   date('y-m-d'),
                       'updated_at'              =>    date('y-m-d'),
                    ]);
                 
                 }
                }
        
            $output = array('msg' => 'Assigned Successfully');
            return back()->with('success', $output);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
	public function updatelocation(Request $request)
    
    { 
		//dd($request);
                  try {
           
                    DB::table('ilrfolders')->where('id',$request->ilrid)->update([
                        'store_code'         =>     $request->store_code, 	
                    //    'city'         =>     $request->city, 
                        'address'         =>     $request->address, 
                       'store_type'			    =>	  $request->store_type, 
                      'email'			    =>	  $request->email, 
                    ]);
                
        
            $output = array('msg' => 'updated Successfully');
            return back()->with('success', $output);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
		  public function folderDelete($id)
    {
      //  dd($id);
      DB::table('ilrfolders')->where('id',$id)->delete();
      DB::table('ilrfolders')->where('parent_id',$id)->delete();
      DB::table('informationresources')->where('ilrfolder_id',$id)->delete();
			   DB::table('ilrfolderassigns')->where('ilrfolder_id',$id)->delete();
        $output = array('msg' => 'Deleted Successfully');
        return back()->with('success', $output);
        
    }
		  public function subfolderDelete($id)
    {
      DB::table('ilrfolders')->where('id',$id)->delete();
      DB::table('informationresources')->where('ilrfolder_id',$id)->delete();
			   DB::table('ilrfolderassigns')->where('ilrfolder_id',$id)->delete();
        $output = array('msg' => 'Deleted Successfully');
        return back()->with('success', $output);
        
    }
	  public function questionDelete($id)
    {
      //  dd($id);
        $ilranswer = Informationresource::find($id);
        $ilranswer->delete();
        $output = array('msg' => 'Deleted Successfully');
        return back()->with('success', $output);
        
    }
		 public function ilrDownload($id, Request $request)
 {
        $ilrid = Crypt::decrypt($id);  
       // dd($ilrid);  
        $ilrfolder =  DB::table('ilranswers')->where('id',$ilrid)->first();
        $filess = $ilrfolder->url;
        $ilrid = $ilrfolder->informationresource_id;
        $ilrdesc = 'file download by';
        $this->activityLog($request, $ilrid,$filess,  $ilrdesc); 
        return response()->download(storage_path('app/backEnd/image/document/'.$ilrfolder->url));
    }
       public function informationCreate($id)
    {
		 $ilrlog = DB::table('ilrtrail')
        ->leftjoin('teammembers','teammembers.id','ilrtrail.createdby')
        ->leftjoin('clientlogins','clientlogins.id','ilrtrail.clientlogin_id')
        ->where('ilrtrail.pageid',$id)->where('ilrtrail.type','ILR')->orderBy('created_at','desc')->select('ilrtrail.*','teammembers.team_member','clientlogins.name')->get();
		  $ilranswers = DB::table('ilranswers')
			  ->leftjoin('teammembers','teammembers.id','ilranswers.updateby')
        ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
        ->where('informationresource_id',$id)->orderBy('created_at', 'desc')->select('ilranswers.*','teammembers.team_member','clientlogins.name')->get();
        $informationresources = Informationresource::where('id',$id)->first();
        return view('backEnd.informationresources.create',compact('informationresources','id','ilranswers','ilrlog'));
    }
	 public function ilrfolder($id)
 {
      //  dd($id);
  //    $ilrfolder = Ilrfolder::with('ilr','ilrsubfolder')->where('client_id',$id)->where('parent_id',null)->get();
    //  $ilrsubfolder = Ilrfolder::where('client_id',$id)->get();
	//	   $irlassign =  DB::table('clientlogins')->where('client_id',$id)->get();
      //  return view('backEnd.informationresources.folderlist',compact('ilrfolder','irlassign','id','ilrsubfolder'));
		    $ilrfolder =  DB::table('ilrfolders')
       //     ->leftjoin('ilranswers','ilranswers.informationresource_id','informationresources.id')
   //     ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
       ->where('ilrfolders.client_id',$id)
      ->select('ilrfolders.*')->get();
      $ilrfolderquestion =  DB::table('informationresources')
      ->where('informationresources.client_id',$id)
      ->select('informationresources.*')->get();
//dd($ilrfolder);
     return view('backEnd.reports.index',compact('ilrfolder','ilrfolderquestion','id'));  
    }
    public function iaddstore(request $request, $id){
        dd($id);
        $request=$request->except(['_token']);
        
        $testdata=DB::table('ilrfolders')->where('store_id',$request->store_id)->first();
        
        if($testdata){
        
        return ('store exist');
        
        
        
        } else {
        
        $request->request->add(['client_id' => $id,'parent_id'=>6]);
        
       $data = DB::table('ilrfolders')->insertGetId(
        
        $request
        
        );
        dd($data);
        return Redirect::route('ilrid', array($id));
        }
    }
	 public function folderStore(Request $request)
    
    { 
		// dd($request->assign);
        $request->validate([
            'name' => "required"
        ]);

        try {
          $data=$request->except(['_token','assign']);
            $data['createdby'] = auth()->user()->teammember_id;
         //   $data['color'] =   '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
             $ilrfolder = Ilrfolder::Create($data);
			      $ilrfolder->save();
            $id = $ilrfolder->id;
            if($request->assign != null){
            foreach ($request->assign as $assign ) 
            {
             DB::table('ilrfolderassigns')->insert([	
                 'ilrfolder_id'         =>     $id, 
                 'client_id'         =>     $request->client_id, 
                'clientlogin_id'         =>     $assign, 	
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
    public function indexview($id)
    {
     $subfolder = DB::table('ilrfolders')->where('parent_id',$id)->first();
     //   dd($subfolder);
        if ($subfolder== null) {
            $informationresourcesDatas = DB::table('informationresources')
            ->leftjoin('teammembers','teammembers.id','informationresources.uploadedby')
            ->where('ilrfolder_id',$id)->select('informationresources.*','teammembers.team_member')->get();
            $clientid = DB::table('ilrfolders')->where('id',$id)->first();
          //  dd($informationresourcesDatas);
            return view('backEnd.informationresources.index',compact('informationresourcesDatas','id','clientid'));
        } else {
           $id = $subfolder->id;
          // dd($id);
            $ilrfolder = Ilrfolder::where('parent_id',$subfolder->parent_id)->get();
         //  dd($ilrfolder);
            return view('backEnd.informationresources.subfolderlist',compact('ilrfolder','id'));
        }
    }
	public function questionUpload(Request $request )
    {
     $request->validate([
         'question' => 'required'
     ]);
   
     try {
         $data = $request->except(['_token']);
       
             $db['client_id']=$request->client_id;
             $db['ilrfolder_id']=$request->ilrfolder_id;
             $db['question']=$request->question ;
             $db['status']= 0;
             Informationresource::Create($db);
  
        $output = array('msg' => 'question insert Successfully');
         return back()->with('success', $output);
     } catch (Exception $e) {
         DB::rollBack();
         Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
         report($e);
         $output = array('msg' => $e->getMessage());
         return back()->withErrors($output)->withInput();
     }
 }
    public function informationUpload(Request $request )
       {
        $request->validate([
            'file' => 'required'
        ]);
      
        try {
            $file=$request->file;
          
            $data = $request->except(['_token']);
            $dataa=Excel::toArray(new Informationresourceimport, $file);
            
            foreach ($dataa[0] as $key => $value) {
           //     $informationresource   = Informationresource::where('question',$value['question'])->pluck('question')->first();
         
           //    if($informationresource == null){
                $db['client_id']=$request->client_id;
                $db['ilrfolder_id']=$request->ilrfolder_id;
                $db['question']=$value['question'] ;
                $db['status']= 0;
                Informationresource::Create($db);
             //  }
              
 }
           $output = array('msg' => 'Excel file upload Successfully');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function informationStore(Request $request)
      { 
        $request->validate([
            'remark' => "required",
        ]);


        try {
            $data=$request->except(['_token']);
            $files = [];
            if($request->hasFile('document'))
            {
                foreach ($request->file('document') as $file) {
					 $name = $file->getClientOriginalName();
                   // $destinationPath = storage_path('app/backEnd/image/document');
                 //   $name = $file->getClientOriginalName();
               //    $s = $file->move($destinationPath, $name);
                         //  dd($s); die;
					 $path = $file->storeAs('clientinfodocument',$name,'s3');
                    $files[] = $name;
                    // $data['url'] = $name;
                 
                }
            }
			   else{
                DB::table('ilranswers')->insert([
                    'informationresource_id' => $request->id, 
                    'url' => '', 
                    'remark' =>  $request->remark, 
                    'updateby' =>  auth()->user()->teammember_id, 
                     'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s')            
                ]); 
                $ilrid = $request->id;
                $ilrdesc = $request->remark. ' by';
                $this->activityLog($request, $ilrid,'',  $ilrdesc);
            }
            foreach($files as $filess )
            {
           // dd($files); die;
               $s = DB::table('ilranswers')->insert([
                    'informationresource_id' => $request->id, 
                    'url' => $filess, 
                    'remark' =>  $request->remark, 
                    'updateby' =>  auth()->user()->teammember_id, 
                     'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s')            
                ]); 
				 $ilrid = $request->id;
                $ilrdesc = 'file uploaded by';
                $this->activityLog($request, $ilrid,$filess,  $ilrdesc); 
            }
            $data = Informationresource::find($request->id);
            $data['uploadedby'] = auth()->user()->teammember_id;
            $data['status'] = 1;
            $data->save();

            //dd($data);
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
     * @param  \App\Models\Informationresource  $informationresource
     * @return \Illuminate\Http\Response
     */
    public function show(Informationresource $informationresource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informationresource  $informationresource
     * @return \Illuminate\Http\Response
     */
    public function edit(Informationresource $informationresource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informationresource  $informationresource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informationresource $informationresource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informationresource  $informationresource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informationresource $informationresource)
    {
        //
    }
	 public function activityLog($request, $ilrid,$filess,  $ilrdesc){
        $actionName = class_basename($request->route()->getActionname());
                $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                  DB::table('ilrtrail')->insert([
                        'createdby' => auth()->user()->teammember_id, 
                        'ip_address' => $request->ip(), 
                        'pagetitle' => $pagename, 
                        'pageid' => $ilrid, 
                        'type' => 'ILR', 
                        'description' =>  $filess.' '.'( '.  $ilrdesc. ' )', 
                        'created_at' => date('y-m-d H:i:s'),       
                        'updated_at' => date('y-m-d H:i:s')       
                    ]);
      }
	 public function ilrhouse(Request $request)
    {
       $id = $request->informationresource_id;
      // dd($request);
       $ilrhouses = DB::table('ilrhouses')
       ->where('informationresource_id',$id)->get();
        return view('backEnd.informationresources.ilrhouse',compact('ilrhouses'));
    }
	  public function ilrsalary(Request $request)
    {
       $id = $request->informationresource_id;
     // dd($request);
       $ilrsalarys = DB::table('ilrsalaries')
       ->where('informationresource_id',$id)->get();
        return view('backEnd.informationresources.ilrsalary',compact('ilrsalarys'));
    }
	  public function ilrbank(Request $request)
    {
      $id = $request->informationresource_id;
      // dd($request);
       $ilrbanks = DB::table('ilrbanks')
       ->where('informationresource_id',$id)->get();
        return view('backEnd.informationresources.ilrbank',compact('ilrbanks'));
    }
	  public function ilraddinformation(Request $request)
    {
       $id = $request->informationresource_id;
     // dd($request);
       $ilraddinformation = DB::table('ilraddinformations')
       ->where('informationresource_id',$id)->first();
        return view('backEnd.informationresources.ilraddinformation',compact('ilraddinformation'));
    }
	 public function assignedUserlist(Request $request)
    {
      //  dd($request);
        if ($request->ajax()) {
            if (isset($request->id))
             {
                 foreach ( DB::table('ilrfolderassigns')
                 ->leftjoin('clientlogins','clientlogins.id','ilrfolderassigns.clientlogin_id')->select('clientlogins.name')
                 ->where('ilrfolder_id',$request->id)->get() as $sub) {
              
                 echo " <tr>
            <td>
              $sub->name
            </td>
            
        </tr>";
                }  
            }
            }
    
    }
	    public function ilrtStore(Request $request)
    { 
      $request->validate([
          'file' => "required",
      ]);

      try {
          $data=$request->except(['_token']);
        
         if($request->hasFile('file'))
          {
               $file=$request->file('file');
            $name = $file->getClientOriginalName();
                  $path = $file->storeAs('clientinfodocument',$name,'s3');
                       $data['file'] = $name;
          }

          DB::table('ilranswers')->insert([	
              'login_id'         =>     auth()->user()->id, 
              'questionid'         =>     $request->questionid, 
              'informationresource_id'         =>     $request->ilrid ??'', 
              'url'         =>                             $data['file'] , 
               'updated_at' => date('Y-m-d H:i:s')     
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
}
