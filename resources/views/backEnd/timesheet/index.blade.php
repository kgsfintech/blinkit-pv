@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('timesheet/create')}}">Add Timesheet</a>
            </li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Time sheet List</small>
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
                        {{-- <form action="{{ url('/timesheet')}}" method="post">
                         @csrf               
                          <div class="row row-sm">
                          <div class="col-3">
                 <div class="form-group">
                    <input type="date" name="todate" value="{{date('Y-m-d')}}" class="form-control">   
               </div>
               </div>
               <div class="col-3">
                 <div class="form-group">
                    <input type="date" name="todate" value="{{date('Y-m-d')}}" class="form-control">   
               </div>
               </div>
               <div class="col-2">
               <div class="form-group">
                  <button type="submit" class="btn btn-success" style="float:center"><i class="fa fa-search" aria-hidden="true"></i></button>   
                  <!-- <button type="submit" class="fa fa-search btn btn-success" class="btn btn-success" style="float:right"></button>    -->
            </div>
             </div>
              </div>
             </form>
              <br>
                        --}}
            <div class="table-responsive">
                <table class="table display table-bo table-striped table-hover basic">
                    <thead>
                       
                        <tr>
                            <th>Client Name</th>
                            <th>Project Name</th>
                            <th>Job Name</th>
                            <th>Work Item</th>
                            <th>Description</th>
                            <th>Status</th>
                            <!-- <th>Createdby</th> -->
                            <th>Hour</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timesheetData as $timesheetData)
                        <tr>
                            <td><a href="{{url('view/timesheet', $timesheetData->id)}}">{{ $timesheetData->client_name }}
                            </td>
                            <td>{{ $timesheetData->project_name }}
                            <td>{{ $timesheetData->job_name }}
                            </td>
                            <td>{{$timesheetData->workitem }}</td>
                            <td>{{$timesheetData->billable_status }}</td>
                            <td>{{$timesheetData->description }}</td>
                            <td>{{$timesheetData->hour }}</td>
                            <td>{{ date('F d,Y', strtotime($timesheetData->created_at)) }}</td>
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
