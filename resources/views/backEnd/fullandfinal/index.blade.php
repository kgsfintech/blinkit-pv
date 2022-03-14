@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    @if(Auth::user()->role_id == 18 || Auth::user()->role_id == 11)
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('fullandfinal/create')}}">Add fullandfinal</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    @endif
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>fullandfinal
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
                            <th>Name</th>
                            <th>Designation </th>
                            <th>Reporting Head</th>
                            <th>Date of Joining</th>
                            <th>Date of Resignation</th>
                            <th>Date of Leaving</th>
                            <th>Notice Period Served </th>
                            <th>Status of Leaving </th>
                            <th>Assignment Data Hanover </th>
                            <th>Laptop Hanover </th>
                            <th>Final Status of Full and Final </th>
                            <th>Full and Final (Days) to be released</th>
                            <th>Reason of Leaving</th>
                            <th>Remark</th>
                            <th>Created By</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fullandfinalDatas as $fullandfinalData)
                        <tr>
                            <td>
                                <a href="{{route('fullandfinal.edit', $fullandfinalData->id)}}">
                                    {{$fullandfinalData->Name }} ( {{ $fullandfinalData->rolename ??''}} )</a></td>

                            <td>@if($fullandfinalData->Designation == 0)
                                <span>Article</span>
                                @elseif($fullandfinalData->Designation == 1)
                                <span>Partner</span>
                                @elseif($fullandfinalData->Designation == 2)
                                <span>Manager</span>
                                @elseif($fullandfinalData->Designation == 3)
                                <span>Auditor</span>
                                @else
                                <span>C.A</span>
                                @endif
                            </td>
                            @php
                            $reporting = DB::table('teammembers')
                            ->leftjoin('roles','roles.id','teammembers.role_id')
                            ->where('teammembers.id',$fullandfinalData->Reporting_Head)
                            ->select('teammembers.team_member','roles.rolename')->first();
                            $team = DB::table('teammembers')
                            ->leftjoin('roles','roles.id','teammembers.role_id')
                            ->where('teammembers.id',$fullandfinalData->createdby)
                            ->select('teammembers.team_member as team','roles.rolename as role')->first();
                            @endphp
                            <td>{{ $reporting->team_member ??''}}</td>
                            @if($fullandfinalData->Date_of_Joining != null)
                            <td>{{ date('F d,Y', strtotime($fullandfinalData->Date_of_Joining ??'')) }}</td>
                            @else
                            <td></td>
                            @endif
                            @if($fullandfinalData->Date_of_Resignation != null)
                            <td>{{ date('F d,Y', strtotime($fullandfinalData->Date_of_Resignation ??'')) }}</td>
                            @else
                            <td></td>
                            @endif
                            @if($fullandfinalData->Date_of_Leaving != null)
                            <td>{{ date('F d,Y', strtotime($fullandfinalData->Date_of_Leaving ??'')) }}</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{ $fullandfinalData->Notice_Period_Served ??''}}</td>
                            <td> @if($fullandfinalData->Status=='0')
                                <span>Voluntary</span>
                                @else
                                <span>In Voluntary</span>
                                @endif</td>
                            <td> @if($fullandfinalData->Assignment_Data_Hanover=='0')
                                <span>Yes</span>
                                @else
                                <span>No</span>
                                @endif</td>
                            <td> @if($fullandfinalData->Laptop_Hanover=='0')
                                <span>Yes</span>
                                @else
                                <span>No</span>
                                @endif</td>
                            <td>@if($fullandfinalData->Final_Status_of_Full_and_Final == 1)
                                <span class="badge badge-pill badge-warning">On Hold</span>
                                @elseif($fullandfinalData->Final_Status_of_Full_and_Final == 0)
                                <span class="badge badge-pill badge-success">Done</span>
                                @else
                                <span class="badge badge-pill badge-danger">Created</span>
                                @endif
                            </td>
                            <td>{{ $fullandfinalData->Full_and_Final_to_be_released ??''}}</td>
                            <td>{{ $fullandfinalData->Reason_of_Leaving ??''}}</td>
                            <td>{{ $fullandfinalData->remark ??''}}</td>
                            <td>{{ $team->team ??''}} ( {{ $team->role ??''}} )</td>
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
