@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('employeereferral/create')}}">Add Employeereferral</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Employeereferral
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
                            <th>Name of Candidate</th>
                            <th>Contact Number of Candidate</th>
                            <th>Position Referred For</th>
							   <th>Attachment</th>
                            <th>Current Organization</th>
                            <th>Relationship with Candidate</th>
							<th>Email Address of Candidate</th>
							<th>Department Referred For</th>
							<th>Current Designation</th>
							<th>Comment </th>
                            <th>Createdby</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeereferralDatas as $employeereferralData)
                        <tr>
                        <td>
                            <a href="{{route('employeereferral.show', $employeereferralData->id)}}">
                                {{$employeereferralData->Name }}</a></td>
                        <td>{{ $employeereferralData->Contact }}</td>
                        <td>{{ $employeereferralData->Position_Referred }}</td>
						  <td><a target="blank" href="{{url('/backEnd/image/employeereferralresume/'.$employeereferralData->attachresume ??'')}}">{{ $employeereferralData->attachresume ??''}} </a></td>
                        <td>{{ $employeereferralData->Current_Organization }}</td>
                        <td>{{ $employeereferralData->Relationship }}</td>
                        <td>{{ $employeereferralData->Email }}</td>
							<td>{{ $employeereferralData->Department }}</td>
							<td>{{ $employeereferralData->Designation }}</td>
							<td>{{ $employeereferralData->Comment }}</td>
                        <td>{{ $employeereferralData->team_member ??'' }} ( {{ $employeereferralData->rolename ??'' }} )</td>
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
