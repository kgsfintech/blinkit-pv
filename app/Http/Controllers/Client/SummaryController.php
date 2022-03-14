<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

use App\Models\Report;
use Illuminate\Http\Request;
use DB;
class SummaryController extends Controller
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
 
    public function index(Request $request)
    {
        //    $ilrfolder =  DB::table('ilrfolders')
        //    ->leftjoin('ilrfolders as a','a.parent_id','ilrfolders.id')
        //    ->leftjoin('informationresources','informationresources.ilrfolder_id','a.id')
        //     p
        //     ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
        //     ->where('a.client_id',auth()->user()->client_id)
        //    ->select('ilrfolders.id as ilrfoldersid','ilrfolders.name as ilrfoldersname'
        //    ,'informationresources.ilrfolder_id as subid','a.name','informationresources.question',
        //    'informationresources.status as infostatus','ilranswers.*','clientlogins.name as clientname')->
        //  ->get();
           $ilrfolder =  DB::table('ilrfolders')
           ->leftjoin('ilrfolders as a','a.parent_id','ilrfolders.id')
            ->leftjoin('informationresources','informationresources.ilrfolder_id','a.id')
        //     ->leftjoin('ilranswers','ilranswers.informationresource_id','informationresources.id')
        //     ->leftjoin('clientlogins','clientlogins.id','ilranswers.clientlogin_id')
            ->where('a.client_id',auth()->user()->client_id)
           ->select('a.name','informationresources.ilrfolder_id as subid')->
           distinct()->get();
           $ilrfolderquestion =  DB::table('informationresources')
           ->select('question')->distinct()->get();
 //dd($ilrfolderquestion);
          return view('client.reports.index',compact('ilrfolder','ilrfolderquestion'));       
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
}
