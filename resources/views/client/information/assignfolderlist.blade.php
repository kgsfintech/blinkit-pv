   <!--Third party Styles(used by this page)--> 
   <link href="{{ url('backEnd/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">
   <link href="{{ url('backEnd/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css')}}" rel="stylesheet">
   <link href="{{ url('backEnd/plugins/jquery.sumoselect/sumoselect.min.css')}}" rel="stylesheet">
@extends('client.layouts.layout') @section('client_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a data-target="#modaldemo1" data-toggle="modal" href="#">Add task</a></li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Irl Folder  List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->

<div class="body-content">
   @component('backEnd.components.alert')

            @endcomponent
    <div class="row">
        @foreach($ilrfolder as $ilrfolderData)
        <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
			   @if($ilrfolderData->name == 'University Agreement')
            <a  href="{{ url('client/ilrlist')}}">
            <div class="p-2  text-white rounded mb-3 p-3 shadow-sm text-center" style="background: @if($loop->iteration % 2 == 0) #37A000; @else #06386A; @endif">
                <div class="header-pretitle fs-11 font-weight-bold text-uppercase" style="color: white">{{$ilrfolderData->name }}</div>
				
                <div class="fs-32 text-monospace">{{ count(DB::table('talents')->latest()->get()) }}</div>
                <small>List of Agreements</small>
				
            </div>
            </a>
			@else
			 <a  href="{{ url('client/informationlist', $ilrfolderData->id)}}">
            <div class="p-2  text-white rounded mb-3 p-3 shadow-sm text-center" style="background: @if($loop->iteration % 2 == 0) #37A000; @else #06386A; @endif">
                <div class="header-pretitle fs-11 font-weight-bold text-uppercase" style="color: white;font-size: 11px!important;">{{ strlen($ilrfolderData->name) > 26 ? substr($ilrfolderData->name,0,26) :$ilrfolderData->name }}</div>
			@php
          $ilr = DB::table('informationresources')->where('ilrfolder_id',$ilrfolderData->id)
     ->where('client_id',auth()->user()->client_id)->get();

          $ilrsubfolder = DB::table('ilrfolders')->where('parent_id',$ilrfolderData->id)
     ->where('client_id',auth()->user()->client_id)->get();
            @endphp
                @if(count($ilr) > 0)
                <div class="fs-32 text-monospace">{{ count($ilr) }}</div>
                <small>Irl</small>
				@else
				<div class="fs-32 text-monospace">{{ count($ilrsubfolder) }}</div>
                <small>Subfolders</small>
				@endif
            </div>
            </a>
			@endif
        </div>
        @endforeach
    </div>
</div>
<!--/.body content-->
@endsection
         
<div class="modal fade" id="modaldemo1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #37A000">
                <h5 style="color: white" class="modal-title font-weight-600">Add Task</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="post" action="{{route('clienttask.store')}}" enctype="multipart/form-data">
                        @csrf


                        <div class="row row-sm">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Assign *</label>
                                    <select class="form-control basic-multiple"  multiple="multiple"  id="category"
                                        name="teammember_id[]" @if(Request::is('task/*/edit'))> <option disabled
                                        style="display:block">Please Select One</option>

                                        @foreach($teammember as $teammemberData)
                                        <option value="{{$teammemberData->id}}" @if(($task->teammember_id) ==
                                            $teammemberData->id) selected
                                            @endif>
                                            {{ $teammemberData->title->title }}. {{ $teammemberData->team_member }}(
                                            {{ $teammemberData->role->rolename}} )</option>
                                        @endforeach


                                        @else
                                        <option></option>
                                        <option value="">Please Select One</option>
                                        @foreach($teammember as $teammemberData)
                                        <option value="{{$teammemberData->id}}">
                                            {{ $teammemberData->name}} </option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Task Name <span class="tx-danger">*</span></label>
                                    <input type="text" name="taskname" value="{{ $task->taskname ?? ''}}"
                                        class="form-control" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Due Date <span class="tx-danger">*</span></label>
                                    <input type="date" name="duedate" value="{{ $task->duedate ?? ''}}"
                                        class="form-control" placeholder="Enter Mobile No">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Priority<span class="tx-danger">*</span></label>
                                    <select class="form-control " name="priority">
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-600">Folder<span class="tx-danger">*</span></label>
                                    <select  class="language form-control"
                                        name="folder_id[]">
                                        <option value="">Please Select One</option>
                                        @foreach($ilrfolder as $ilrfolderData)
                                        <option value="{{$ilrfolderData->id}}">
                                            {{ $ilrfolderData->name}} </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-600">Description <span class="tx-danger">*</span></label>
                                    <textarea rows="4" name="description" value="" class="centered form-control"
                                        id="editor"
                                        placeholder="Enter Description">{!! $task->description ??'' !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
                            <a class="btn btn-secondary" href="{{ url('task') }}">
                                Back</a>

                        </div>



                    </form>


                </div>
            </div>

        </div>
    </div>
</div>                    

