@extends('backEnd.layouts.layout') @section('backEnd_content')
<style>
    .example:hover {
        overflow-y: scroll;
        /* Add the ability to scroll */

    }


    /* Hide scrollbar for IE, Edge and Firefox */
    .example {
        height: 157px;
        margin: 0 auto;
        overflow: hidden;
    }

</style>
<style>
    .examplee:hover {
        overflow-y: scroll;
        /* Add the ability to scroll */

    }


    /* Hide scrollbar for IE, Edge and Firefox */
    .examplee {
        height: 175px;
        margin: 0 auto;
        overflow: hidden;
    }

</style>
<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">

    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="media-body">
                <h1 class="font-weight-bold"></h1>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card" style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);height:160px;">
                <div class="card-body">
                    <fieldset class="form-group">

                        <table class="table display table-bordered table-striped table-hover">

                            <tbody>

                                <tr>
                                    <td><b>Assignment Name : </b></td>
                                    <td>{{ $assignmentbudgetingDatas->assignment_name}}</td>

                                    <td><b>Assignment Code :</b></td>
                                    <td>{{ $assignmentbudgetingDatas->assignmentgenerate_id}}</td>

                                </tr>
                                <tr>
                                    <td><b>Client Name : </b></td>
                                    <td>{{ $assignmentbudgetingDatas->client_name}}</td>
                                    <td><b>Period End : </b></td>
                                    <td style="color: cornflowerblue;">{{ $assignmentbudgetingDatas->periodend}}</td>

                                </tr>
                                <tr>
                                    <td><b>Status : </b></td>
                                    <td>@if($assignmentbudgetingDatas->status==1)
                                        <span class="badge badge-primary">OPEN</span>
                                        @else
                                        <span class="badge badge-danger">CLOSED</span>
                                        @endif</td>
                                    <td><b>Billing Frequency : </b></td>
                                    <td>@if($assignmentbudgetingDatas->billingfrequency==0)
                                        <span>Monthly</span>
                                        @elseif($assignmentbudgetingDatas->billingfrequency==1)
                                        <span>Quarterly</span>
                                        @elseif($assignmentbudgetingDatas->billingfrequency==2)
                                        <span>Half Yearly</span>
                                        @else
                                        <span>Yearly</span>
                                        @endif
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-5">
                    <div class="card" style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);height:250px;">
                        <div class="card-body">
                            <div class="card-head">
                                <b>Teammember List</b>
                            </div>
                            <hr>
                            <div class="table-responsive example">
                                <table class="table display table-bordered table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Mobile No</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teammemberDatas as $teammemberData)
                                        <tr>
                                            <td>{{$teammemberData->title }}. {{$teammemberData->team_member }}</td>
                                            <td>@if($teammemberData->type==0)
                                                <span >Team Leader</span>
                                                @else
                                                <span >Staff</span>
                                                @endif</td>
                                            <td><a
                                                    href="tel:={{$teammemberData->mobile_no }}">{{$teammemberData->mobile_no }}</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card " style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);height:250px;">
                        <div class="card-body">

                            <div class="card-head">
                                <b>Client Contact</b>
                                <a data-toggle="modal" data-target="#exampleModal1" style="float:right;width:20px;"><img
                                        src="{{ url('backEnd/image/add-icon.png')}}" /></a>
                            </div>
                            <hr>
                            <div class="table-responsive example">
                                <table class="table display table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contactDatas as $contactData)
                                        <tr>
                                            <td>{{$contactData->clientname }}</td>
                                            <td>{{$contactData->clientemail }}</td>
                                            <td>{{$contactData->clientdesignation }}</td>
                                            <td><a
                                                    href="tel:={{$contactData->clientphone }}">{{$contactData->clientphone }}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>
        </div>
    </div>
    @foreach($assignmentcheckDatas as $assignmentcheckData)
    <div class="card mb-4">
        <div class="card-body">

            <div class="card-head">
                <b>{{ $assignmentcheckData->financial_name }}</b>
            </div>
            <hr>
            <div class="row">
                @php
 $assignmentcheckk = 
     DB::table('subfinancialclassfications')
     ->where('assignmentgenerate_id', $assignmentbudgetingDatas->assignmentgenerate_id)
     ->select('assignmentgenerate_id')->first();
    // dd($assignmentcheckk); die;
   if( $assignmentcheckk == null){
    $ssub=App\Models\Subfinancialclassfication::where('financialstatemantclassfication_id',$assignmentcheckData->id)
    ->where('assignmentgenerate_id', null)
                ->get();
              
   }
   else{
    $ssub=App\Models\Subfinancialclassfication::where('financialstatemantclassfication_id',$assignmentcheckData->id)
                ->get();
             
   }
  
                @endphp
                @foreach($ssub as $ssub)
                <div class="col-md-3" style="
    padding: 10px;
">
                    <div class="card" style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);height:292px;">
                        <form>
                            <div class="card-body">
                                <div class="card-head">
                                    <b>{{ $ssub->subclassficationname }}</b>
                                </div>
                                <hr>
                                <ul class="todo-list examplee">
                                    @php
 $auditquestionscheck = DB::table('auditquestions')
     ->where('assignmentgenerate_id', $assignmentbudgetingDatas->assignmentgenerate_id)
   ->select('assignmentgenerate_id')->first();
  // dd($auditquestionscheck);
  if( $auditquestionscheck == null){
    $subb = App\Models\Auditquestion::leftJoin('subfinancialclassfications',function
                                    ($join)
                                    {$join->on('auditquestions.subclassfied_id','subfinancialclassfications.id'); })
                                    ->leftJoin('steplists',function ($join)
                                    {$join->on('auditquestions.steplist_id','steplists.id'); })
                                    ->where('auditquestions.subclassfied_id',$ssub->id)
                                    ->where('auditquestions.financialstatemantclassfication_id',$assignmentcheckData->id)
                                    ->where('auditquestions.assignmentgenerate_id', null)
                                    ->select('stepname','steplists.id')->distinct()->get();
  }else
  {
   $subb = App\Models\Auditquestion::leftJoin('subfinancialclassfications',function
                                    ($join)
                                    {$join->on('auditquestions.subclassfied_id','subfinancialclassfications.id'); })
                                    ->leftJoin('steplists',function ($join)
                                    {$join->on('auditquestions.steplist_id','steplists.id'); })
                                    ->where('auditquestions.subclassfied_id',$ssub->id)
                                    ->where('auditquestions.financialstatemantclassfication_id',$assignmentcheckData->id)
                                    ->select('stepname','steplists.id')->distinct()->get();
  }
                                    @endphp
                                    @foreach($subb as $sub )
                                    <li>
                                        <label for="todo1"> <a
                                                href="{{url('/auditchecklist?'.'steplist='.$sub->id.'&&'.'subclassfied='.$ssub->id.'&&'.'assignmentid='.$assignmentbudgetingDatas->assignmentgenerate_id.'&&'.'financialid='.$ssub->financialstatemantclassfication_id)}}">{{ $sub->stepname}}</a>
                                         

                                            @php
                                            $status = App\Models\Checklistanswer::
                                            leftJoin('statuses',function ($join)
                                            {$join->on('checklistanswers.status','statuses.id'); })
                                            ->where('steplist_id',$sub->id)
                                            ->where('financialstatemantclassfication_id',$ssub->financialstatemantclassfication_id)
                                            ->where('subclassfied_id',$ssub->id)
                                            ->where('assignment_id',$assignmentbudgetingDatas->assignmentgenerate_id)->select('statuses.*')->orderBy('id',
                                            'asc')->first();

                                            $count = App\Models\Auditquestion::where('steplist_id',$sub->id)
                                            ->where('financialstatemantclassfication_id',$ssub->financialstatemantclassfication_id)
                                            ->where('subclassfied_id',$ssub->id)->select('id')->get();
                                            $countauditqstn = count($count);

                                            $countan = App\Models\Checklistanswer::
                                            leftJoin('statuses',function ($join)
                                            {$join->on('checklistanswers.status','statuses.id'); })
                                            ->where('steplist_id',$sub->id)
                                            ->where('financialstatemantclassfication_id',$ssub->financialstatemantclassfication_id)
                                            ->where('subclassfied_id',$ssub->id)
                                            ->where('assignment_id',$assignmentbudgetingDatas->assignmentgenerate_id)->select('statuses.*')->get();
                                            $countauditanswer = count($countan);

                                            @endphp
                                            @if( $countauditanswer == $countauditqstn)
                                            @if($status)
                                            <span class="{{ $status->color ??'' }}">{{ $status->name ??''}}</span>
                                            @else
                                            <span class="badge badge-primary">OPEN</span>
                                            @endif
                                            @else
                                            <span class="badge badge-primary">OPEN</span> @endif
                                        </label>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                @endforeach


            </div>
            <br>
        </div>
    </div>
    @endforeach
</div>
<!--/.body content-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('viewassignment/contactupdate') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="exampleModalLabel4">Add Client Contact</h5>
                    <div>
                        <ul>
                            @foreach ($errors->all() as $e)
                            <li style="color:red;">{{$e}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="details-form-field form-group row">

                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-600"> Name</label>
                                <input type="text" name="clientname" value="" class=" form-control"
                                    placeholder="Enter Client Name">
                                <input type="text" name="client_id" hidden
                                    value="{{$assignmentbudgetingDatas->client_id}}" class=" form-control"
                                    placeholder="Enter Client Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-600"> Email</label>
                                <input type="text" name="clientemail" value="" class=" form-control"
                                    placeholder="Enter Client Email">
                            </div>
                        </div>
                    </div>

                    <div class="details-form-field form-group row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-600"> Phone</label>
                                <input type="text" name="clientphone" value="" class=" form-control"
                                    placeholder="Enter Client Phone">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-600"> Designation</label>
                                <input type="text" name="clientdesignation" value="" class=" form-control"
                                    placeholder="Enter Client Designation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }

</script>
@endsection
