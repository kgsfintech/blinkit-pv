
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('task/create')}}">Add task</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-user-add-outline"></i></div>
            <div class="media-body">
               <a href="{{url('home')}}"> <h1 class="font-weight-bold" style="color:black;">Home</h1></a>
                <small>Task List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
     @component('backEnd.components.alert')

        @endcomponent
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                           
                            <th> Name</th>
                            <th>Assign</th>
							 <th>Assign By</th>
                            <th>Created Date</th>
							<th>Due Date</th>
                            <th>Description</th>
                            <th>Status</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taskDatas as $taskData)
                        <tr>
                            <td><a href="{{url('view/task', $taskData->id)}}" >{{$taskData->taskname ??''}}</a></td>
						@php
                        $taskassig = DB::table('taskassign')
        ->leftjoin('teammembers','teammembers.id','taskassign.teammember_id')
        ->leftjoin('roles','roles.id','teammembers.role_id')
        ->where('taskassign.task_id',$taskData->id)->select('teammembers.team_member','roles.rolename')->get();
                  //  dd($taskassig);
                    @endphp
                            @if($taskData->createdby ==  Auth::user()->teammember_id)
                            <td> @foreach($taskassig as $taskassign)<span><a  >{{$taskassign->team_member ??'' }} ( {{$taskassign->rolename}} )</a></span>,@endforeach</td>
                          @else
							 <td>@foreach($taskassig as $taskassign)<span>{{$taskassign->team_member ??'' }} ( {{$taskassign->rolename}} )</span> ,@endforeach</td>
							@endif
							
							<td>{{ App\Models\Teammember::select('team_member')->where('id',$taskData->createdby)->first()->team_member ?? '' }}</td>
							<td>{{ date('F d,Y', strtotime($taskData->created_at)) }}</td>
                            <td>{{ date('F d,Y', strtotime($taskData->duedate)) }}</td>
                           
                          <td>{!! $taskData->description ??''!!}</td>
                          <td>@if($taskData->status ==  0)
                            <span class="badge badge-pill badge-warning">pending</span>
                            @else
                            <span class="badge badge-pill badge-success">completed</span>
                          
                            
                            @endif</td>
                      
                            
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->

@endsection


