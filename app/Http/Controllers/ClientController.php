<?php

namespace App\Http\Controllers;
use App\Models\Clientfolder;
use App\Models\Client;
use App\Models\State;
use App\Models\Clientcontact;
use App\Models\Permission;
use App\Models\Clientdocument;
use App\Models\Teammember;
use Illuminate\Http\Request;
use App\imports\Clientcontactimport;
use Maatwebsite\Excel\HeadingRowImport;
use Excel;
use App\imports\Debtorimport;
use App\Models\Debtor;
use DB;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
class ClientController extends Controller
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
    public function changeStatus(Request $request)
    { 
      //  dd($request);
        $user = Client::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
     public function add(Request $request, $clientid)
    {
          $state = State::latest()->get();
          $client = Client::where('id', $clientid)->first();
         // dd($client);
        return view('backEnd.client.create',compact('state','client'));
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
       public function viewclientlist($client_name)
    {
    // dd($client_name);
    $clientDatas = DB::table('clients')
  ->where('clients.client_name',$client_name)
   ->select('clients.*')->get();
   $clientid =  DB::table('clients')
   ->where('clients.client_name',$client_name)
    ->pluck('id')->first();
  // dd($clientid);
    return view('backEnd.client.index',compact('clientDatas','clientid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function viewClient($id)
    {
      
        $clientList =  DB::table('clients')
        ->leftjoin('states','states.id','clients.c_state')
        ->where('clients.id', $id)->select('clients.*','states.statename')->first();
        $clientcontactList =  Clientcontact::where('client_id', $id)->get();
        $clientassignment =  DB::table('assignmentmappings')
            ->leftjoin('assignmentbudgetings','assignmentbudgetings.assignmentgenerate_id','assignmentmappings.assignmentgenerate_id')
            ->leftjoin('clients','clients.id','assignmentbudgetings.client_id')
            ->leftjoin('assignments','assignments.id','assignmentmappings.assignment_id')
            ->where('assignmentbudgetings.client_id',$id)
            ->select('assignmentmappings.*','assignmentbudgetings.duedate',
            'assignments.assignment_name','clients.client_name')->distinct()->get();
        $clientfileDatas = DB::table('clientdocuments')
        ->leftjoin('users','users.id','clientdocuments.updated_by')
        ->leftjoin('clients','clients.id','clientdocuments.client_id')
        ->leftjoin('teammembers','teammembers.id','users.teammember_id')
        ->leftjoin('roles','roles.id','teammembers.role_id')
        ->where('clientdocuments.client_id',$id)
        ->select('clientdocuments.*','teammembers.team_member','roles.rolename','clients.client_name')->get();
        
            $clientfile  =  DB::table('clientfolders')
          ->where('client_id',$id)->get();
          
             $clientlogin  =  DB::table('clientlogs')
            ->leftjoin('clientlogins','clientlogins.id','clientlogs.clientlogin_id')
            ->where('clientlogs.client_id',$id)
            ->select('clientlogs.*','clientlogins.name','clientlogins.email')->get();
            
        return view('backEnd.clientlist',compact('id','clientlogin','clientfile','clientcontactList','clientList','clientassignment','clientfileDatas'));   
    }
    public function create(Request $request)
    {
          $state = State::latest()->get();
    
        return view('backEnd.client.create',compact('state'));
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
             'client_name' => "required",
             'mobileno' => "required|numeric",
             'emailid' => "required|email"
         ]);

        try {
            $authid = auth()->user()->id;
            $data=$request->except(['_token']);
            if(auth()->user()->role_id == 11 || auth()->user()->role_id == 12 || auth()->user()->role_id == 13){
            $filess=array();
            if($files=$request->file('filess'))
        {
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('backEnd/image/client/document/',$name);
                $filess[]=$name;
               // dd($name);
            }
    
        }
        $data['status'] = 1;
            $clientModel = Client::Create($data);
            $clientModel->save();
            $id = $clientModel->id;
				  if($request->document_name[0] != null){
         $count=count($request->document_name);
        // dd($count);
         for($i=0;$i<$count;$i++){
            DB::table('clientdocuments')->insert([
                'client_id'   	=>     $id,
                'type'   	=>     $request->type[$i],
                'document_name'   	=>     $request->document_name[$i],
               'filess'=>  $filess[$i],
                'created_by'  => $authid,
                'updated_by'  => $authid,
                'created_at'			    =>	   date('y-m-d'),
                'updated_at'              =>    date('y-m-d'),
            ]);
         }
				  }
              
            
            DB::table('clients')->where('id',$id)->update([	
                'client_code'         =>     $id+1000,
                'createdbyadmin_id'  => $authid,
                'updatedbyadmin_id'  => $authid,
                 ]);
                    DB::table('clientcontacts')->insert([	
                'clientname'         =>     $request->name,
                'clientemail'  => $request->emailid,
                'clientphone'  => $request->mobileno,
                'clientdesignation'  => $request->clientdesignation,
                'client_id'   	=>     $id,
                'created_at'			    =>	   date('y-m-d'),
                'updated_at'              =>    date('y-m-d'),
                 ]);
                    $actionName = class_basename($request->route()->getActionname());
                $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                  DB::table('activitylogs')->insert([
                        'user_id' => auth()->user()->teammember_id, 
                        'ip_address' => $request->ip(), 
                        'activitytitle' => $pagename, 
                        'description' => 'New Client Added'.' '.'( '. $request->client_name. ' )', 
                        'created_at' => date('y-m-d'),       
                        'updated_at' => date('y-m-d')       
                    ]);
            $output = array('msg' => 'Create Successfully');
            return back()->with('success', $output);
                  }
                  else {
                    $filess=array();
                    if($files=$request->file('filess'))
                {
                    foreach($files as $file){
                        $name=$file->getClientOriginalName();
                        $file->move('backEnd/image/client/document/',$name);
                        $filess[]=$name;
                       // dd($name);
                    }
            
                }
                $data['status'] = 0;
                    $clientModel = Client::Create($data);
                    $clientModel->save();
                    $id = $clientModel->id;
					    if($request->document_name[0] != null){
                 $count=count($request->document_name);
                // dd($count);
                 for($i=0;$i<$count;$i++){
                    DB::table('clientdocuments')->insert([
                        'client_id'   	=>     $id,
                        'type'   	=>     $request->type[$i],
                        'document_name'   	=>     $request->document_name[$i],
                       'filess'=>  $filess[$i],
                        'created_by'  => $authid,
                        'updated_by'  => $authid,
                        'created_at'			    =>	   date('y-m-d'),
                        'updated_at'              =>    date('y-m-d'),
                    ]);
                 }
                      
						} 
                    DB::table('clients')->where('id',$id)->update([	
                        'client_code'         =>     $id+1000,
                        'createdbyadmin_id'  => $authid,
                        'updatedbyadmin_id'  => $authid,
                         ]);
                           DB::table('clientcontacts')->insert([	
                            'clientname'         =>     $request->name,
                            'clientemail'  => $request->emailid,
                            'clientphone'  => $request->mobileno,
                            'clientdesignation'  => $request->clientdesignation,
                            'client_id'   	=>     $id,
                            'created_at'			    =>	   date('y-m-d'),
                            'updated_at'              =>    date('y-m-d'),
                             ]);
                            $actionName = class_basename($request->route()->getActionname());
                        $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                          DB::table('activitylogs')->insert([
                                'user_id' =>  auth()->user()->teammember_id, 
                                'ip_address' => $request->ip(), 
                                'activitytitle' => $pagename, 
                                'description' => 'New Client Added'.' '.'( '. $request->client_name. ' )', 
                                'created_at' => date('y-m-d'),       
                                'updated_at' => date('y-m-d')       
                            ]);
                    $output = array('msg' => 'Create Successfully');
                    return back()->with('success', $output);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $state = State::latest()->get();
      //  dd($teammember);
      $clientdocument = DB::table('clientdocuments')
       ->leftjoin('users','users.id','clientdocuments.updated_by')
       ->leftjoin('teammembers','teammembers.id','users.teammember_id')
       ->where('clientdocuments.client_id',$id)
       ->select('clientdocuments.*','teammembers.team_member')->get();
      // dd($clientdocument);
        $client = Client::where('id', $id)->first();
      //dd($client);
        return view('backEnd.client.edit', compact('state','id', 'client','clientdocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //  dd($request->filess);
        // $request->validate([
        //     'team_member' => "required",
        //     'mobile_no' => "required|numeric",
        //     'pancardno' => "required|numeric",
        //     'team_member' => "required"
        // ]);
        try {
            $authid = auth()->user()->id;
            $data=$request->except(['_token']);
            $filess=array();
            if($files=$request->file('filess'))
        {
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('backEnd/image/client/document/',$name);
                $filess[]=$name;
            }
    
        }
          Client::find($id)->update($data);
            if($request->document_name[0] != null){
         $count=count($request->document_name);
      //   dd($count);
         for($i=0;$i<$count;$i++){
           
                DB::table('clientdocuments')->insert([
                    'client_id'   	=>     $id,
                    'type'   	=>     $request->type[$i],
                    'document_name'   	=>     $request->document_name[$i],
                    'filess'=>  $filess[$i] ??'',
                    'created_at'			    =>	   date('y-m-d'),
                    'updated_at'              =>    date('y-m-d'),
                ]);
             
      
         }
		}
            DB::table('clients')->where('id',$id)->update([	
                'client_code'         =>     $id+1000,
                'updatedbyadmin_id'  => $authid,
                 ]);
                 $actionName = class_basename($request->route()->getActionname());
            $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                $id = auth()->user()->teammember_id;
              DB::table('activitylogs')->insert([
                    'user_id' => $id, 
                    'ip_address' => $request->ip(), 
                    'activitytitle' => $pagename, 
                    'description' => ' Client Data Edit'.' '.'( '. $request->client_name. ' )', 
                    'created_at' => date('y-m-d'),       
                    'updated_at' => date('y-m-d')       
                ]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroyClient($id = '')
    {
           try {
               Clientcontact::destroy($id);
               $output = array('msg' => 'Deleted Successfully');
               return back()->with('status', $output);
           } catch (Exception $e) {
               DB::rollBack();
               Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
               report($e);
               $output = array('msg' => $e->getMessage());
               return back()->withErrors($output)->withInput();
           }
       }
       public function destroyClientdocument($id = '',Request $request)
       {
            try {
              
                $clientdata =  DB::table('clientdocuments')
                ->leftjoin('clients','clients.id','clientdocuments.client_id')->
                where('clientdocuments.id', $id)
                ->select('clientdocuments.*','clients.client_name')->first();
              //  dd($clientdata);  die;
                $actionName = class_basename($request->route()->getActionname());
                $pagename = substr($actionName, 0, strpos($actionName, "Controller"));
                  DB::table('activitylogs')->insert([
                        'user_id' =>auth()->user()->teammember_id, 
                        'ip_address' => $request->ip(), 
                        'activitytitle' => $pagename, 
                        'description' => $clientdata->document_name.' '.'( '.$clientdata->client_name.' )'.' '.'deleted', 
                        'created_at' => date('y-m-d'),       
                        'updated_at' => date('y-m-d')       
                    ]);
                    Clientdocument::destroy($id);
                  $output = array('msg' => 'Deleted Successfully');
                  return back()->with('status', $output);
              } catch (Exception $e) {
                  DB::rollBack();
                  Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                  report($e);
                  $output = array('msg' => $e->getMessage());
                  return back()->withErrors($output)->withInput();
              }
          }
    public function editContact($id = '')
    {
        $client = Client::where('id', $id)->first();
        $contactDatas = Clientcontact::where('client_id', $id)->get();
     //   dd($priceDatas);
        return view('backEnd.client.addclientcontact', compact('id','client','contactDatas'));
    }
    public function contactUpdate(Request $request, $id = '')
    {
       // dd($request);
        $request->validate([
            'clientname' => 'required'
        ]);

        try {
           $data=$request->except(['_token']);
            Clientcontact::Create($data);
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
    public function assignmentContactUpdate(Request $request)
    {
       // dd($request);
        $request->validate([
            'clientname' => 'required'
        ]);

        try {
           $data=$request->except(['_token']);
            Clientcontact::Create($data);
             return back()->with('alert','Client contact Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
     public function clientContact()
    {
        $clientContacts = Clientcontact::latest()->with('client')->get();
         return view('backEnd.client.clientindex',compact('clientContacts'));
    }
    public function clientCreate()
    {
        $client = Client::latest()->get();
         return view('backEnd.client.clientfileform',compact('client'));
    }
    public function clientFile()
    {
      //  $clientfileDatas = Clientdocument::latest()->with('client')->get();
        $clientfileDatas = DB::table('clientdocuments')
        ->leftjoin('users','users.id','clientdocuments.updated_by')
        ->leftjoin('clients','clients.id','clientdocuments.client_id')
        ->leftjoin('teammembers','teammembers.id','users.teammember_id')
        ->select('clientdocuments.*','teammembers.team_member','clients.client_name')->get();
      //  dd($clientfileDatas);
         return view('backEnd.client.clientfileindex',compact('clientfileDatas'));
    }
    public function clientfileStore(Request $request)
    {
        $request->validate([
            'document_name' => 'required',
            'filess' => 'required',
        ]);

            try {
              $authid =  auth()->user()->id;
                $data=$request->except(['_token']);
                if($request->hasFile('filess'))
                {
                   $file=$request->file('filess');
                    $extension=$file->getClientOriginalExtension();
                    $filename=time().'.'.$extension;
                    $file->move('backEnd/image/client/document/',$filename);
                    $data['filess']=$filename;
                }
                $data['created_by']=$authid;
                $data['updated_by']=$authid;
                 Clientdocument::Create($data);
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
    public function clientcontactUpload(Request $request )
    {
        $request->validate([
            'file' => 'required'
        ]);
      
        try {
            $file=$request->file;
          
            $data = $request->except(['_token']);
            $dataa=Excel::toArray(new Clientcontactimport, $file);
            
            foreach ($dataa[0] as $key => $value) {
                $clientid   = Client::where('client_name',$value['clientname'])->pluck('id')->first();
             //   dd($value['clientname']);
               if($clientid){
                $db['client_id']=$clientid;
                $db['clientname']=$value['clientstaff'] ;
                 $db['clientphone']=$value['clientphone'] ;
                 $db['clientemail']=$value['clientemail'];
                 $db['clientdesignation']=$value['clientdesignation'];
                 $data= Clientcontact::Create($db);
               }
              
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
     public function debtorExcel(Request $request )
    {
     //  dd($request);
        $request->validate([
            'file' => 'required'
        ]);
      
        try {
            $file=$request->file;
          
            $data = $request->except(['_token']);
            $dataa=Excel::toArray(new Debtorimport, $file);
         //   dd($dataa); die;
            foreach ($dataa[0] as $key => $value) {
              
             //   $debtorid   = Debtor::where('name',$value['name'])->pluck('name')->first();
             
            //    if($debtorid){
                $db['name']=$value['name'];
                $db['amount']=$value['amount'] ;
               
                 $db['date']=$value['date'] ;
                 $db['year']=$value['year'] ;
                 $db['address']=$value['address'];
                 $db['email']=$value['email'];
                 $db['client_id']=$request->clientid;
                 $db['type']=$request->type;
                 $db['created_by']=auth()->user()->teammember_id;
                 $debtor= Debtor::Create($db);
               //          $debtor->save();
        //          //echo "sdcns";die;
        //      $debtorid = $debtor->id;

        //     $data = array(
        //         'name' =>  $value['name'],
        //         'email' =>  $value['email'],
        //         'year' =>  $value['year'],
        //         'date' =>  $value['date'],
        //         'amount' =>  $value['amount'],
        //         'clientid' => $request->clientid,
        //         'debtorid' => $debtorid,
        //         'yes' => 1,
        //         'no' => 0
        //    );
        //     Mail::send('emails.debtorform', $data, function ($msg) use($data){
        //         $msg->to($data['email']);
        //         $msg->subject('Kgs Confirmation');
        //      });
        //    
            
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
    public function clientdocumentOpen($id)
    {
        $doc = Clientdocument::where('id',$id)->first();
        
        $file = $doc->filess;
      
        if (File::isFile($file))
        {
            $file = File::get($file);
          
            $response = Response::make($file, 200);
            $content_types = [
                'application/octet-stream', // txt etc
                'application/msword', // doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                'application/vnd.ms-excel', // xls
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
                'application/pdf', // pdf
            ];
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', $content_types);

            return $response;
        }
    }
      public function debtorPdf($id)
    {
        $debtorpdf = Debtor::where('id',$id)->first();
         $debtorconfirmation = DB::table('debtorconfirmations')->where('debtor_id',$id)->get();
        return view('backEnd.debtorform',compact('debtorpdf','debtorconfirmation'));
    }
      public function adminFile(Request $request)
    {
        $request->validate([
             'file' => 'required',
        ]);

        try {
            $data=$request->except(['_token']);
            $files = [];
            if($request->hasFile('file'))
            {
                foreach ($request->file('file') as $file) {
                    //$destinationPath = storage_path('app/backEnd/image/clientfile');
                  //  $name = $file->getClientOriginalName();
                  // $s = $file->move($destinationPath, $name);
                         //  dd($s); die;
                      $name = $file->getClientOriginalName();
					 $path = $file->storeAs('clientdocument',$name,'s3');
					$files[] = $name;
                 
                }
            }
            foreach($files as $filess )
            {
           // dd($files); die;
               $s = DB::table('clientfiles')->insert([
                    'name' => $request->name, 
                    'createdby' =>auth()->user()->teammember_id,
				     'clientfolder_id' =>  $request->clientfolder_id, 
                    'client_id' =>  $request->clientid, 
                    'file' => $filess, 
                     'created_at' => date('y-m-d'), 
                    'updated_at' => date('y-m-d')            
                ]);  
            
            }
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
   public function folderList($id)
    {
        $filelist  = DB::table('clientfiles')
        ->leftjoin('clientlogins','clientlogins.id','clientfiles.clientlogin_id')
			    ->leftjoin('teammembers','teammembers.id','clientfiles.createdby')
        ->where('clientfiles.clientfolder_id',$id)
       ->select('clientfiles.*','clientlogins.name','teammembers.team_member')->get();
	    $clientid  = DB::table('clientfolders') ->where('id',$id)
        ->select('clientfolders.*')->first();
       // dd($filelist);
        return view('backEnd.client.filelist',compact('filelist','clientid'));
    }
    public function folderDestroy ($id = '')
    {
       // dd($id);
        try {
            DB::table('clientfiles')->delete($id);
            $output = array('msg' => 'Deleted Successfully');
            return back()->with('statuss', $output);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
	  public function folderStore(Request $request)
    
    { 
      //  dd($request);
        $request->validate([
            'name' => "required"
        ]);

        try {
            $data=$request->except(['_token']);
            $data['client_id'] = $request->client_id;
            $data['createdby'] = auth()->user()->teammember_id;
            Clientfolder::Create($data);
            $output = array('msg' => 'folder Created Successfully');
            return back()->with('success', $output);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    


}
		 public function clientAssets(Request $request,$id="")
    {
			// dd($id);
          $assets = DB::table('clientassests')->where(['client_id'=>$id])->get();
    
        return view('backEnd.client.assets',compact('assets','id'));
    }
	public function assetStore(Request $request)
    
    { 
      //  dd($request);
        $request->validate([
            'asset_type' => "required"
        ]);

        try {
            $data=$request->except(['_token']);
           // $data['client_id'] = $request->client_id;
           // $data['createdby'] = auth()->user()->teammember_id;
            DB::table('clientassests')->insert($data);
            $output = array('msg' => 'Asset Added Successfully');
            return back()->with('success', $output);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            report($e);
            $output = array('msg' => $e->getMessage());
            return back()->withErrors($output)->withInput();
        }
    }
	
	   public function assetRegisterMerge(Request $request, $id)
    {
        // $assettype = DB::table('clientassests')->get();
        // $assetregister = DB::table('assest_register')->get();
        // foreach($assetregister as $asset){
        //   $thisassettype=$asset->asset_type;
        //   $assettypeq= DB::table('clientassets')->where(['asset_type'=> $thisassettype])->get();
        // }

        $all_data = DB::table("asset_register")
            ->leftjoin("clientassests", "asset_register.asset_type", "=", "clientassests.asset_type")
            ->select("clientassests.q1", "clientassests.q2", "clientassests.q3", "clientassests.q4", "asset_register.id as asset_id", "asset_register.asset_type", "asset_register.barcode")
            ->where(['asset_register.client_id'=>$id, "clientassests.client_id" => $id])->get();

        foreach ($all_data as $item) {
            Db::Table("asset_register")->where(["id" => $item->asset_id])->update([
                "q1" => $item->q1,
                "q2" => $item->q2,
                "q3" => $item->q3,
                "q4" => $item->q4,

            ]);
        }
        return redirect('/home');
    }
    public function assetRegisterInput(Request $request, $id)
    {
        return view('backEnd.client.pvsearch', ['id' => $id]);
    }
    public function assetRegisterSearch(Request $request, $id)
    {
        $search = $request->search;
        if (auth()->user()->role_id == 11) {
            $asset = DB::table("asset_register")->where(['barcode' => $search])->first();
            if (!$asset) {
                return "No Result Found";
            }
            return view("backEnd.client.pv", ['asset' => $asset, "id" => $id]);
        } else {
            $asset = DB::table("asset_register")->where(['barcode' => $search])->first();
            if ($asset) {
                $data = DB::table("stuff_and_store")->where(['staff_id' => auth()->user()->teammember_id, 'store_code' => $asset->store_code])->get();
            } else {
                return "No Result Found";
            }
            if (isset($data[0])) {
                return view("backEnd.client.pv", ['asset' => $asset, "id" => $id]);
            } else {
                return "No Result Found";
            }
        }

        // return view("backEnd.client.pv", ['asset' => $asset, "id" => $id]);
    }
    public function update_asset(Request $request, $id)
    {

        $a1 = $request->a1;
        $a2 = $request->a2;
        $a3 = $request->a3;
        $a4 = $request->a4;
        $asset_id = $request->asset_id;

        $res = DB::table("asset_register")->where(['id' => $asset_id])->update([
            "a1" => $a1,
            "a2" => $a2,
            "a3" => $a3,
            "a4" => $a4,
        ]);

        if ($res) {
            return redirect("clientassetregistersearchinput/" . $id);
        } else {
            return redirect("clientassetregistersearchinput/" . $id);
        }
    }

    public function assetRegisterpv(Request $request)
    {
        return view('backEnd.client.pv');
    }

    public function staff_vs_store(Request $request, $client_id)
    {
        $clients = DB::table("clients")->select("id", "client_name")->get();
        $stores = DB::table("ilrfolders")->select("id", "name", "store_code")->get();
        $staffs = DB::table("teammembers")->select("id", "team_member")->where(['status' => 1])->get();
        $data = [
            'client_id' => $client_id,
            'clients' => $clients,
            'stores' => $stores,
            'staffs' => $staffs,
        ];
        return view("backEnd.client.staff_vs_store", $data);
    }

    public function staff_vs_store_add(Request $request, $client_id)
    {
        $staff_id = $request->staff_id;
        $client_id = $request->client_id;
        $store_code = $request->store_code;

        $res = DB::table("stuff_and_store")->insert([
            "staff_id" => $staff_id,
            "client_id" => $client_id,
            "store_code" => $store_code,
        ]);

        if ($res) {
            return redirect("/staff_vs_store/" . $client_id)->with("success", "Staff - Store added successfully");
        } else {
            return redirect("/staff_vs_store/" . $client_id)->with("fail", "Staff - Store cannot be added");
        }
    }
	public function clientAssetsRegister(Request $request, $id = "")
    {
        // dd($id);
        if (auth()->user()->role_id == 11) {
            $assets = DB::table('asset_register')->where(['client_id'=>$id])->get();
            
        } else {
            $data = DB::table("stuff_and_store")->where(['staff_id' => auth()->user()->teammember_id])->select('store_code')->get();
            $assets = DB::table("asset_register")->whereIn('store_code', $data )->where(['client_id'=>$id])->get();
           
           
        }
        return view('backEnd.client.assetregister', compact('assets', 'id'));
    }

public function assetRegisterStore(Request $request) {
// dd($request);
$request->validate([
'asset_type' => "required"
]); try {
$data = $request->except(['_token']);
// $data['client_id'] = $request->client_id;
// $data['createdby'] = auth()->user()->teammember_id;
DB::table('asset_register')->insert($data);
$output = array('msg' => 'Asset Added Successfully');
return back()->with('success', $output);
} catch (Exception $e) {
DB::rollBack();
Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
report($e);
$output = array('msg' => $e->getMessage());
return back()->withErrors($output)->withInput();
}
}

public function barcode_generator(Request $request)
    {
         $store_code = $request->store_code;
       // $store_code = "UP14001";
        $assets = DB::table("asset_register")->where(["store_code" => $store_code])->get();
        $temp = $assets[0]->asset_type; // "Fan"
        $i = 1;
        $last_count = [];
        foreach ($assets as $asset) {
            if ($asset->asset_type == $temp) {
                $barcode = $asset->store_code . strtoupper(substr($asset->asset_type, 0, 3)) . $i++;
                DB::table("asset_register")->where(["id" => $asset->id])->update([
                    "barcode" => $barcode
                ]);
                $last_count[$asset->asset_type] = $i;
            } else {
                $temp = $asset->asset_type;
                $i = 1;
                if (isset($last_count[$asset->asset_type])) {
                    $i = $last_count[$asset->asset_type];
                }
                $barcode = $asset->store_code . strtoupper(substr($asset->asset_type, 0, 3)) . $i++;
                DB::table("asset_register")->where(["id" => $asset->id])->update([
                    "barcode" => $barcode
                ]);
                $last_count[$asset->asset_type] = $i;
            }
        }
        return redirect()->back();
    }
    
}
