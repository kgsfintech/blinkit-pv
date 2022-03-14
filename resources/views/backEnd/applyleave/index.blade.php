@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('applyleave/create')}}">Add Applyleave</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>From now on you will start your activities.</small>
            </div>
        </div>
    </div>
</div>
<div class="body-content">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
            <div class="p-2 bg-info text-white rounded mb-3 p-3 shadow-sm text-center">
                <div class="opacity-50 header-pretitle fs-11 font-weight-bold text-uppercase">Birthday/Religious Festival</div>
                <div class="fs-32 text-monospace"><i class="far fa-calendar-alt" style=" margin-bottom: 12px;font-size: 48px; margin-top: 16px;"></i></div>
                <small>Available : {{ $birthday->holiday - $countbirthday ??''}}</small><br>
                <small>Booked : {{ $countbirthday ??''}}</small>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
            <div class="p-2 bg-primary text-white rounded mb-3 p-3 shadow-sm text-center">
                <div class="opacity-50 header-pretitle fs-11 font-weight-bold text-uppercase">Casual Leave</div>
                <div class="fs-32 text-monospace"><i class="far fa-calendar-alt" style=" margin-bottom: 12px;font-size: 48px; margin-top: 16px;"></i></div>
                <small>Available : {{ $Casual->holiday - $countCasual ??''}}</small><br>
                <small>Booked : {{ $countCasual ??''}}</small>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
            <div class="p-2 bg-success text-white rounded mb-3 p-3 shadow-sm text-center">
                <div class="opacity-50 header-pretitle fs-11 font-weight-bold text-uppercase">Compensatory off</div>
                <div class="fs-32 text-monospace"><i class="far fa-calendar-alt" style=" margin-bottom: 12px;font-size: 48px; margin-top: 16px;"></i></div>
                <small>Available : 0</small><br>
                <small>Booked : 0</small>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
            <div class="p-2 text-white rounded mb-3 p-3 shadow-sm text-center" style="background-color: darkcyan;">
                <div class="opacity-50 header-pretitle fs-11 font-weight-bold text-uppercase">Sick Leave</div>
                <div class="fs-32 text-monospace"><i class="far fa-calendar-alt" style=" margin-bottom: 12px;font-size: 48px; margin-top: 16px;"></i></div>
                <small>Available : {{ $Sick->holiday - $countSick ??''}}</small><br>
                <small>Booked : {{ $countSick ??''}}</small>
            </div>
        </div>

    </div>


</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header" style="background:#37A000">
        
          <div class="d-flex justify-content-between align-items-center">

              <div>
                  <h6 class="fs-17 font-weight-600 mb-0">
                      <span style="color:white;">Apply Leave List</span>
                
                  </h6>
              </div>

          </div>
      </div>
        <div class="card-body">
            @component('backEnd.components.alert')

            @endcomponent
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            <th>Leave</th>
                             <th>Approver</th>
                        
                            <th>Reason for leave</th>
                            <th> From Date</th>
                            <th> To Date</th>
                            <!-- <th>Team Email ID (If Any)</th> -->
                           
                            <th>Raised Date</th>
                            <th>Status</th>
                            <th>Raisedby</th>

                        </tr>
                    </thead>
                    <tbody  >
                        @foreach($applyleaveDatas as $applyleaveDatas)
                        <tr>
                            <td>
                                <a href="{{route('applyleave.show', $applyleaveDatas->id)}}"> {{ $applyleaveDatas->name ??''}}</a></td>
                        <td>{{ App\Models\Teammember::select('team_member')->
                        where('id',$applyleaveDatas->approver)->first()->team_member ?? ''}}</td>
                        
                                <td>{{ $applyleaveDatas->reasonleave ??'' }} </td>
                       
                        <td>{{ date('F d,Y', strtotime($applyleaveDatas->from)) ??''}}</td> 
                        <td>{{ date('F d,Y', strtotime($applyleaveDatas->to)) ??''}}</td> 
                       
                        <td>{{ date('F d,Y', strtotime($applyleaveDatas->created_at)) ??''}}</td> 
                        <td>@if($applyleaveDatas->status==0)
                                    <span class="badge badge-pill badge-warning">Created</span>
                                    @elseif($applyleaveDatas->status==1)
                                    <span class="badge badge-success">Approved</span>
                                    @elseif($applyleaveDatas->status==2)
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                    <td>   {{ $applyleaveDatas->team_member ??''}}</td>
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
