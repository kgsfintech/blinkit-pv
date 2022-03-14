<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

use App\Models\Report;
use Illuminate\Http\Request;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:clientlogin');
    }
    public function search(Request $request)
    {
       // dd($request);
        if ($request->subfolderid !=null && $request->ilrfolderid !=null && $request->startdate ==null && $request->enddate == null){
        $ilrfolder = DB::table('ilrfolders')
        ->leftjoin('ilrfolders as a','a.parent_id','ilrfolders.id')
        ->leftjoin('informationresources','informationresources.ilrfolder_id','a.id')
         ->leftjoin('ilranswers','ilranswers.informationresource_id','informationresources.id')
         ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
        ->where('a.parent_id',$request->ilrfolderid)->where('a.id',$request->subfolderid)
        ->where('a.client_id',auth()->user()->client_id)
     ->select('a.name','informationresources.question','ilranswers.*','clientlogins.name as clientname')
        ->get();
        $ilrfoldername = DB::table('ilrfolders')->where('parent_id',null)
        ->where('client_id',auth()->user()->client_id)->get();
      return view('client.report.index',compact('ilrfolder','ilrfoldername'));
        }
        elseif ($request->subfolderid !=null && $request->ilrfolderid !=null && $request->startdate !=null && $request->enddate == null){
            $ilrfolder = DB::table('ilrfolders')
            ->leftjoin('ilrfolders as a','a.parent_id','ilrfolders.id')
            ->leftjoin('informationresources','informationresources.ilrfolder_id','a.id')
             ->leftjoin('ilranswers','ilranswers.informationresource_id','informationresources.id')
             ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
            ->where('a.parent_id',$request->ilrfolderid)->where('a.id',$request->subfolderid)
            ->where('a.client_id',auth()->user()->client_id)
            ->where('ilranswers.created_at','>=',$request->startdate)
         ->select('a.name','informationresources.question','ilranswers.*','clientlogins.name as clientname')
            ->get();
            $ilrfoldername = DB::table('ilrfolders')->where('parent_id',null)
            ->where('client_id',auth()->user()->client_id)->get();
          return view('client.report.index',compact('ilrfolder','ilrfoldername'));
            }
        elseif ($request->subfolderid !=null && $request->ilrfolderid !=null && $request->startdate !=null && $request->enddate != null){
            $ilrfolder = DB::table('ilrfolders')
            ->leftjoin('ilrfolders as a','a.parent_id','ilrfolders.id')
            ->leftjoin('informationresources','informationresources.ilrfolder_id','a.id')
             ->leftjoin('ilranswers','ilranswers.informationresource_id','informationresources.id')
             ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
            ->where('a.parent_id',$request->ilrfolderid)->where('a.id',$request->subfolderid)
            ->where('a.client_id',auth()->user()->client_id)
            ->where('ilranswers.created_at','>',$request->startdate)
            ->where('ilranswers.created_at','<',$request->enddate)
         ->select('a.name','informationresources.question','ilranswers.*','clientlogins.name as clientname')
            ->get();
            $ilrfoldername = DB::table('ilrfolders')->where('parent_id',null)
            ->where('client_id',auth()->user()->client_id)->get();
          return view('client.report.index',compact('ilrfolder','ilrfoldername'));
            }
    }
	
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if (isset($request->category_id)) {
               // dd($request->category_id);
                echo "<option>Please Select One</option>";
                foreach (DB::table('ilrfolders')->where('parent_id',$request->category_id)->select('ilrfolders.*')->get() as $sub) {
 echo "<option value='" . $sub->id . "'>" . $sub->name . "</option>";
                }
            }
        }
        else{
            $ilrfoldername = DB::table('ilrfolders')->where('parent_id',null)
            ->where('client_id',auth()->user()->client_id)->get();
            $ilrfolder = null;
         //   dd($ilrfolder);
          return view('client.report.index',compact('ilrfoldername','ilrfolder'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
	 public function particularIndex()
    {
		            $ilrfolder =  DB::table('ilranswers')
           ->leftjoin('informationresources','informationresources.id','ilranswers.informationresource_id')
						->leftjoin('infoparticulars','infoparticulars.ilranswers_id','ilranswers.id')
          ->whereNotNull('ilranswers.status')
						->where('infoparticulars.createdby',auth()->user()->id)
           ->select('ilranswers.id','ilranswers.status','ilranswers.created_at',
					'ilranswers.particular','informationresources.ilrfolder_id','informationresources.ilrfolder_id',
					'informationresources.question')->distinct('particular')
           ->get();
    //dd($ilrfolder);
          return view('client.particular.index',compact('ilrfolder'));       
	 }
}
