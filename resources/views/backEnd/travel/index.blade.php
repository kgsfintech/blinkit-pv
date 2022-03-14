@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('travel/create')}}">Add Travel</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>travel
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
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Nature of Assignment</th>
                            <th>Approvel </th>
                            <th>Expected date of Arrival</th>
                            <th>Expected date of Departure</th>
                            <th>Travel Status</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($travelDatas as $travelData)
                        <tr>
                            <td>
                                <a href="{{route('travel.show', $travelData->id)}}">    {{$travelData->client_name ??''}}</a></td>

                            <td>{{ $travelData->Nature_of_Assignment }}</td>
                            <td>{{ $travelData->team_member }}</td>
                            @if($travelData->Expected_date_of_arrival != null)
                            <td>{{ date('F d,Y', strtotime($travelData->Expected_date_of_arrival ??'')) }}</td>
                            @else
                            <td></td>
                            @endif
                            @if($travelData->Expected_date_of_departure != null)
                            <td>{{ date('F d,Y', strtotime($travelData->Expected_date_of_departure ??'')) }}</td>
                            @else
                            <td></td>
                            @endif
                         <td>@if($travelData->travelstatus == 0)
                            <span class="badge badge-pill badge-warning">Created</span>
                            @elseif($travelData->travelstatus == 1)
                            <span class="badge badge-pill badge-success">Approved</span>
                            @else
                            <span class="badge badge-pill badge-danger">Reject</span>
                            @endif
                        </td>
                    <td>@if($travelData->Status == 2)
                            <span>Pending</span>
                            
                        @elseif($travelData->Status == 0)
                            <span>Paid</span>
                            @else
                            <span>On Hold</span>
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
