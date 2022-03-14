@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
   <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('outstationconveyance/create')}}">Add Outstation Conveyance</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Outstation Conveyance List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">

        <div class="card-body">
            @component('backEnd.components.alert')

            @endcomponent
            <div class="table-responsive">
                <table id="example" class="table display table-bordered table-striped table-hover">
                   <thead>
                       <tr>
                           <th>Name</th>
                           <th>DATE & ASSIGNMENT</th>
                            <th>Audit Period from Date</th>
                           <th>Audit Period to Date</th>
                           <th>Visiting Period from Date</th>
                           <th>Visiting Period to Date</th>
                           <th>Tickets Booked By</th>
                           <th>Fare</th>
                           <th>Conveyance Charges</th>
                           <th>Coolie Charges</th>
                           <th>During Journey</th>
                           <th>Miscellaneous Exp</th>
                           <th>Food Expenses</th>
                           <th>Approved Rate of TA/Day</th>
                           <th>TA Claimed </th>
                           <th>Total Travelling BILL</th>
                           <th>Advance</th>
                           <th>Advance Received</th>
                           <th>Mark only</th>
                           <th>Total Amount</th>
                         
                           <th>Remarks</th>
                           <th>Createdby</th>
                           <th>Status</th>
                           
                       </tr>
                   </thead>
                   <tbody>
                   @foreach($outstationData as $outstationData)
                   <tr>
                   <td><a href="{{route('outstationconveyance.show', $outstationData->id)}}" >{{ $outstationData->client_name }} </td>
                      
                      <td>{{$outstationData->Assignment }}</td>
                      <td>@if($outstationData->Audit_from_date!=null)
						  {{ date('F d,Y', strtotime($outstationData->Audit_from_date)) }}
					   @else
					   @endif</td> 
                      <td>@if($outstationData->Audit_period_date!=null)
						  {{ date('F d,Y', strtotime($outstationData->Audit_period_date)) }}
					   @else
					   @endif</td>
                      <td>@if($outstationData->Visiting_from_date!=null)
						  {{ date('F d,Y', strtotime($outstationData->Visiting_from_date)) }}
					   @else
					   @endif</td> 
                      <td>@if($outstationData->Visiting_date!=null){{ date('F d,Y', strtotime($outstationData->Visiting_date)) }}
					   @else
					   @endif</td>
                      <td>{{$outstationData->Tickets_Booked_By }}</td>
                      <td>{{$outstationData->Fare }}</td>
                      <td>{{$outstationData->Conveyance_Charges }}</td>
                      <td>{{$outstationData->Coolie_Charges }}</td>
                      <td>{{$outstationData->During_Journey }}</td>
                      <td>{{$outstationData->Miscellaneous_Exp }}</td>
                      <td>{{$outstationData->Food_Expenses }}</td>
                      <td>{{$outstationData->Approved_Rate }}</td>
                      <td>{{$outstationData->TA_Claimed }}</td>
                      <td>{{$outstationData->Travelling_BILL }}</td>
                      <td>{{$outstationData->Advance }}</td>
                      <td>{{$outstationData->Advance_received }}</td>
                      <td>{{$outstationData->oval }}</td>
                      <td>{{$outstationData->bill }}</td>
                     <td>{{$outstationData->Remarks }}</td>
                      <td>{{ App\Models\Teammember::select('team_member')->where('id',$outstationData->createdby)->first()->team_member ?? ''}}</td>
                      <td>@if($outstationData->Status==0)
                                  <span class="badge badge-info">Created</span>
                                  @elseif($outstationData->Status==1)
                                  <span class="badge badge-success">Approved</span>
                                  @elseif($outstationData->Status==2)
                                  <span class="badge badge-danger">Rejected</span>
                                  @elseif($outstationData->Status==4)
                                  <span class="badge badge-secondary">Pending For Correction/Clarification</span>
                                 
                                  @else
                                  <span class="badge badge-warning">Submitted</span>
                                  @endif</td>
                       </tr>
                                  @endforeach
                   </tbody>
               </table>
           </div>
        </div>
    </div>

</div>
<!--/.body content-->
@endsection
