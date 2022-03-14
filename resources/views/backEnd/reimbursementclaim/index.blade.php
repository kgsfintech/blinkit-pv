@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
   <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('reimbursementclaim/create')}}">Add Reimbursement Claim</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Reimbursement Claim
                    List</small>
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
                            <th>Date of Expense</th>
                            <th>Type of Expense</th>
                            <th>Approved Amount</th>
							 <th>Actual Amount</th>
                            <th>Location</th>
                            <th>File</th>
                            <th>Approver</th>
                            <th>Status</th>
                            <th>Createdby</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reimbursementDatas as $reimbursementDatas)
                        <tr>
                        <td>{{ date('F d,Y', strtotime($reimbursementDatas->Date_of_Expense)) }}</td>    
                        <td>  <a href="{{route('reimbursementclaim.show', $reimbursementDatas->id)}}">{{$reimbursementDatas->Type_of_Expense }}</a></td>
                        <td>{{$reimbursementDatas->Approved_Amount }}</td>
                        <td>{{$reimbursementDatas->Actual_Amount }}</td>
                        <td>{{$reimbursementDatas->Location }}</td>
                        <td><a target="blank" href="{{url('/backEnd/image/claim/'.$reimbursementDatas->attachment)}}">{{ $reimbursementDatas->attachment ??''}}</a></td>
                        <td>{{ $reimbursementDatas->team_member }} ( {{ $reimbursementDatas->rolename }} )</td>
                        <td>@if($reimbursementDatas->Status==0)
                                    <span class="badge badge-info">Created</span>
                                    @elseif($reimbursementDatas->Status==1)
                                    <span class="badge badge-success">Approved</span>
                                    @elseif($reimbursementDatas->Status==2)
                                    <span class="badge badge-danger">Rejected</span>
                                    @else
                                    <span class="badge badge-warning">Submitted</span>
                                    @endif</td>

                        <td>{{ App\Models\Teammember::select('team_member')->where('id',$reimbursementDatas->createdby)->first()->team_member ?? ''}}</td>
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
