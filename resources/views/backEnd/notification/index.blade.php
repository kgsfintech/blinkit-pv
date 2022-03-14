
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('notification/create')}}">Add notification</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>notification List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
 
    @if(auth()->user()->role_id != 11)
    <div class="card mb-4" >
        <div class="card-header" style="background-color:#ff000029;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0"> <i style="font-size: 20px;padding:10px;"
                            class="typcn typcn-bell"></i>Notification</h6>
                </div>

            </div>
        </div>
        <div class="notification-list">
                @foreach($notificationDatas as $notificationData)
<div class="card-body">
                <div class="media new">
                    <div class="img-user online"><img src="{{ asset('backEnd/image/teammember/profilepic/'.$notificationData->profilepic) }}" alt="">
                    </div>
                    <div class="media-body">
                        <h6> {{ $notificationData->title}}</h6>
                        <span> <small class="text-muted"><a 
                            class="d-block fs-15 font-weight-600 text-sm mb-0"><span
                                style="color:#007bff;font-size: small;">created by <b style="color: black;">{{ $notificationData->team_member}}</b></span>
                          </a></small></span>
                    </div>
                    <div class="inbox-date ml-auto">
                        <div><small><i class="far fa-clock mr-1"></i>{{ date('F jS', strtotime($notificationData->created_at)) }},
                                {{ date('H:i A', strtotime($notificationData->created_at)) }}</small></div>
                    </div>
                </div>
            </div>
                @endforeach
           
        </div>
      
    </div>
    @else
    <div class="card mb-4">
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notificationDatas as $notificationData)
                        <tr>
                            <td>{{$notificationData->title }}</td>
                            <td>@if($notificationData->targettype==1)
                                <span>Individual</span>
                                @elseif($notificationData->targettype==2)
                                <span>All Member</span>
                                @else
                                <span>Partner</span>
                                @endif</td>
                          
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div><!--/.body content-->

@endsection


