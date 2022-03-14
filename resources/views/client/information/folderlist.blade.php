<style>
[id="heart"] {
  position: absolute;
  left: -100vw;
}

[for="heart"] {
  color: #F4F4F5;
  cursor: pointer;
  font-size: 1em;
  align-self: center;  
  transition: color 0.2s ease-in-out;
}

[for="heart"]:hover {
  color: grey;
}

[for="heart"]::selection {
  color: none;
  background: transparent;
}

[id="hearts"] {
  position: absolute;
  left: -100vw;
}

[for="hearts"] {
  color: #aab8c2;
  cursor: pointer;
  font-size: 1em;
  align-self: center;  
  transition: color 0.2s ease-in-out;
}

[for="hearts"]:hover {
  color: grey;
}

[for="hearts"]::selection {
  color: none;
  background: transparent;
}

.abc
{
    color: red;

}



@keyframes heart {0%, 17.5% {font-size: 0;}}

    </style>
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
            @if(Auth::user()->id == 16 || Auth::user()->id == 44 || Auth::user()->id == 36)
            <div class="">
                <a data-toggle="modal" data-target="#exampleModal12" style="float: right;color:white;" class="btn btn-success ml-2">Add Subfolder</a>
            </div>
            @endif
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->

<div class="body-content">
    @component('backEnd.components.alert')

            @endcomponent
     <div class="row">
        @foreach($ilrfolder as $ilrfolderData)
        @php
        $assign = DB::table('ilrfolderassigns')
        ->leftjoin('clientlogins','clientlogins.id','ilrfolderassigns.clientlogin_id')->select('clientlogins.name')
        ->where('ilrfolder_id',$ilrfolderData->id)->get();
        $favourite = DB::table('favourites')
->where('typeid',$ilrfolderData->id)->where('type','folder')->where('userid',auth()->user()->teammember_id)->count();
                   @endphp
        <div class="col-md-6 col-lg-3">
            @if(count($ilrfolderData->ilr) > 0 && count($ilrfolderData->ilrsubfolder) == 0)
            <div style="float: right;margin-right: 4px;">
                @if($favourite == 1) 
                {{-- <button type="submit" class="btn btn-success" style="float:right"> ❤</button> --}}
                <input type="checkbox" checked id="hearts" data-id="{{$ilrfolderData->id}}" class="rates" >
                <label for="heart" style="color:red;">★</label>
                @endif
                @if($favourite == 0) 
                {{-- <button type="submit" class="btn btn-success" style="float:right"> ❤</button> --}}
                <input type="checkbox"  id="heart" data-id="{{$ilrfolderData->id}}" class="rates" >
                <label for="heart"  class="bca" >★</label>
                @endif
              
              </div>
              @else
              <div style="float: right">
                
                <input type="checkbox" @if($favourite == 1) checked @endif id="star5" data-id="{{$ilrfolderData->id}}" class="subfolder" >
                <label for="star5" title="text"></label>
              
              </div>   
              @endif
            <!--Active users indicator-->
			
			 <a  href="{{ url('client/informationlist', $ilrfolderData->id)}}">
            <div class="p-2  text-white rounded mb-3 p-3 shadow-sm text-center" style="background: @if($loop->iteration % 2 == 0) #37A000; @else #06386A; @endif">
                <div class="header-pretitle fs-11 font-weight-bold text-uppercase" style="color: white;font-size: 11px!important;">{{ strlen($ilrfolderData->name) > 26 ? substr($ilrfolderData->name,0,26) :$ilrfolderData->name }}</div>
				@if(count($ilrfolderData->ilr) > 0)
                <div class="fs-32 text-monospace">{{ count($ilrfolderData->ilr) }}</div>
                <small>Irl</small>
				@else
				<div class="fs-32 text-monospace">{{ count($ilrfolderData->ilrsubfolder) }}</div>
                <small>Subfolders</small>
				@endif
            </div>
            </a>
		
        </div>
        @endforeach
    </div>
</div>
<!--/.body content-->
    
<div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ url('client/informationfolder/store')}}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background: #218838;">
                    <h5 style="color:white;" class="modal-title font-weight-600" id="exampleModalLabel4">Add Folder</h5>
                    <div>
                        <ul>
                            @foreach ($errors->all() as $e)
                            <li style="color:red;">{{$e}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="details-form-field form-group row">
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Name :</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="name" type="text">
                            <input id="name" hidden class="form-control" name="parent_id" value="{{ $id ??''}}" type="text">
                        </div>

                    </div>
                    <div class="details-form-field form-group row">
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Color :</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="color" type="color">

                        </div>

                    </div>
                  

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                         

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
                                    <select  required class="form-control basic-multiple"  multiple="multiple"  id="category"
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
                                    <select required class="language form-control"
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   
<script>
    $(function() {
   $('.subfolder').change(function() {
       var user_id = $(this).data('id'); 
      
       $.ajax({
             type: "GET",
             dataType: "json",
             url: "{{ url('/client/subfolder') }}",
             data: { 'user_id': user_id},
             success: function(response){
                
               console.log(data.success)
             }
         });
     })
   })
 </script>    
<script>
    $(function() {
   $('.rates').change(function() {
       var user_id = $(this).data('id'); 
       $(this).removeClass('bca').addClass('abc');
       debugger;
       $.ajax({
             type: "GET",
             dataType: "json",
             url: "{{ url('/client/subfavourite') }}",
             data: { 'user_id': user_id},
             success: function(response){
             
               console.log(data.success)
             }
         });
     })
   })
 </script>    