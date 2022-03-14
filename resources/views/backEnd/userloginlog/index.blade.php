
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-time d-block"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>User Activity Log</small>
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
                            <th>Team Member</th>
                            <th>Last login</th>
                            <th> Ip Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userlogDatas as $userlogData)
                        <tr>
                            <td>{{$userlogData->team_member }} ( {{$userlogData->rolename }} )</td>
                            <td>{{ date('F d,Y', strtotime($userlogData->lastlogindateandtime)) }}   {{ date('h:i A', strtotime($userlogData->lastlogindateandtime)) }}</td>
                            <td>{{$userlogData->ip_address }}</td>
                         
                         
                           
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->

@endsection


