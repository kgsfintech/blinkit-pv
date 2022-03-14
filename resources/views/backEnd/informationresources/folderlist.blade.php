<!--Third party Styles(used by this page)-->
<link href="{{ url('backEnd/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ url('backEnd/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{ url('backEnd/plugins/jquery.sumoselect/sumoselect.min.css')}}" rel="stylesheet">

@extends('backEnd.layouts.layout') @section('backEnd_content')
<style>
    a{
        cursor: pointer;
    }
    .user-menu {
    position: relative; 
    position: absolute;
    right: 17px;
    top: 1px;
   
}
</style>
<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
			<li class="breadcrumb-item"><a href="{{url('/viewclient/'.$id)}}" >Back <i class="fa fa-reply"></i></a></li>
            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#exampleModal12">Add Folder</a></li>
			
          <li class="breadcrumb-item"><a data-toggle="modal" data-target="#exampleModal11">Add Folder Assign</a></li>
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
{{-- <div class="body-content">
 <div class="card mb-4">

        <div class="card-body">
          <div>
                @if(session()->has('success'))
                <div class="alert alert-success">
                    @if(is_array(session()->get('success')))
                    @foreach (session()->get('success') as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                    @else
                    <p>{{ session()->get('success') }}</p>
                    @endif
                </div>
                @endif
                @if(session()->has('statuss'))
                <div class="alert alert-danger">
                  @if(is_array(session()->get('statuss')))
                  @foreach (session()->get('statuss') as $message)
                      <p>{{ $message }}</p>
                  @endforeach
                  @else
                      <p>{{ session()->get('success') }}</p>
                  @endif
                </div>
            @endif
                <div>
                    <ul>
                        @foreach ($errors->all() as $e)
                        <li style="color:red;">{{$e}}</li>
                        @endforeach
                    </ul>
                </div></div> 
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>

                            <th>Name</th>
 <th>Assigned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ilrfolder as $ilrfolderData)
                        <tr>

                           
                          <td><a style="font-size: 16px;"
                                    href="{{ url('informationlist', $ilrfolderData->id)}}"><i
                                        class="far fa-folder"> <b>{{$ilrfolderData->name }}</b></i></a></td>
     @php
                             $assign = DB::table('ilrfolderassigns')
                             ->leftjoin('clientlogins','clientlogins.id','ilrfolderassigns.clientlogin_id')->select('clientlogins.name')
                             ->where('ilrfolder_id',$ilrfolderData->id)->get();
                                        @endphp
                            <td> @foreach($assign as $assigns) <span class="badge badge-pill badge-success">{{ $assigns->name ??''}}</span> @endforeach</td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> --}}

<div class="body-content">
    @component('backEnd.components.alert')

    @endcomponent   
  <div class="row">
    @foreach($ilrfolder as $ilrfolderData)
    @php
                            $assign = DB::table('ilrfolderassigns')
                            ->leftjoin('clientlogins','clientlogins.id','ilrfolderassigns.clientlogin_id')->select('clientlogins.name')
                            ->where('ilrfolder_id',$ilrfolderData->id)->get();
                                       @endphp
<div class="col-md-6 col-lg-3">
    <!--Active users indicator-->
     @if(Auth::user()->role_id == 11 )
    
    <ul class="navbar-nav flex-row align-items-center ml-auto">
        <li class="nav-item dropdown user-menu">
            <a class="foldertoggle" style=" color:white" href="#" data-toggle="dropdown">
                <!--<img src="assets/dist/img/user2-160x160.png" alt="">-->
                 <i class="ti-more-alt"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-left" style="height: 55px;">
              <a style="margin-left: 10px;" href="{{url('/ilrfolder/delete/'.$ilrfolderData->id)}}"  onclick="return confirm('Are you sure you want to delete this item?');" class="dropdown-item">Delete</a>
             </div><!--/.dropdown-menu -->
        </li>
    </ul><!--/.navbar nav-->
    

      @endif
    <div class="p-2  text-white rounded mb-3 p-3 shadow-sm text-center" style="background: @if($loop->iteration % 2 == 0) #37A000; @else #06386A; @endif">
        <div class="header-pretitle fs-11 font-weight-bold text-uppercase" style="color: white;font-size: 11px!important;">{{ strlen($ilrfolderData->name) > 26 ? substr($ilrfolderData->name,0,26) :$ilrfolderData->name }}</div>
        <a
        href="{{ url('informationlist', $ilrfolderData->id)}}">  @if(count($ilrfolderData->ilr) > 0)
        <div class="fs-32 text-monospace" style="color: white">{{ count($ilrfolderData->ilr) }}</div>
        <small style="color: white">Irl</small>
        @else
        <div class="fs-32 text-monospace" style="color: white">{{ count($ilrfolderData->ilrsubfolder) }}</div>
        <small style="color: white">Subfolders</small>
        @endif </a>
        @php
       $assign = DB::table('ilrfolderassigns')
       ->leftjoin('clientlogins','clientlogins.id','ilrfolderassigns.clientlogin_id')->select('clientlogins.name')
       ->where('ilrfolder_id',$ilrfolderData->id)->get();
      // dd($assign);
                  @endphp
       <br>@if($assign->isnotEmpty())
       <a data-toggle="modal" id="editCompany" data-toggle="modal" data-id="{{ $ilrfolderData->id }}" data-target="#exampleModal112"><span class="badge badge-pill badge-info" style="margin-top: 6px;"> 
        <i class="fas fa-info-circle"></i> Assigned</span></a>@else <span class="badge badge-pill badge-info" style="margin-top: 6px;"> 
            <i class="fas fa-info-circle"></i> Not Assigned</span> @endif
       
                  <div class="modal fade" id="exampleModal112" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <form id="detailsForm" method="post" action="{{ url('/informationfolder/store')}}"
                              enctype="multipart/form-data">
                              @csrf
                              <div class="modal-header" style="background: #218838;">
                                  <h5 style="color:white;" class="modal-title font-weight-600" id="exampleModalLabel4">Assign Irl User list</h5>
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
                                  <div class="table-responsive">
                                      <table class="table display table-bordered table-striped table-hover">
                                          <thead>
                                              <tr>
                      
                                                  <th>Name</th>
                                              </tr>
                                          </thead>
                                          <tbody id="out_id">
                      
                                        </tbody>
                                      </table>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
    </div>
 
</div>
              @endforeach
</div>


</div>
<!--/.body content-->
<!-- Modal -->

<div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('/informationfolder/store')}}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background: #218838;">
                    <h5 style="color:white;" class="modal-title font-weight-600" id="exampleModalLabel4">Add Name</h5>
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
                            <input id="name" hidden class="form-control" name="client_id" value="{{ $id }}" type="text">
                        </div>

                    </div>
                    <div class="details-form-field form-group row">
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Sub Folder of :</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="parent_id">
                                <option value="">No Subfolder</option>
                                @foreach($ilrsubfolder as $ilrfolderData)
                                <option value="{{$ilrfolderData->id}}">
                                    @if($ilrfolderData->parent_id == null)( Subfolder of)@endif    {{ $ilrfolderData->name }}</option>

                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="details-form-field form-group row">
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Color :</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="color" type="color">

                        </div>

                    </div>
                    <div class="details-form-field form-group row">
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Assign(optional) :</label>
                        <div class="col-sm-9">
                            <select class="form-control basic-multiple" multiple="multiple" id="category"
                                name="assign[]" @if(Request::is('task/*/edit'))> <option disabled
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
                                @foreach($irlassign as $teammemberData)
                                <option value="{{$teammemberData->id}}">
                                    {{ $teammemberData->name }}</option>

                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection

  <!-- Modal -->
<div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('assign/folder')}}"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-header" style="background: #37A000">
                <h5 style="color:white;" class="modal-title font-weight-600" id="exampleModalLabel4">Assign Folder</h5>
                <div >
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
                             <label for="name" class="col-sm-3 col-form-label font-weight-600">Assign:</label>
                        <div class="col-sm-9">
                            <select required class="language form-control" id="exampleFormControlSelect1"  multiple="multiple"
                            name="assign[]" @if(Request::is('task/*/edit'))> <option disabled
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
                            @foreach($irlassign as $teammemberData)
                            <option value="{{$teammemberData->id}}">
                                {{ $teammemberData->name }}</option>

                            @endforeach
                            @endif
                        </select>
                            <input id="name" hidden class="form-control" name="client_id" value="{{ $id }}" type="text">
                        </div>
                           
                    </div> 
                    <div class="details-form-field form-group row">
                             <label for="name" class="col-sm-3 col-form-label font-weight-600">Folder:</label>
                        <div class="col-sm-9">
                            <select required multiple="multiple" class="select2" name="folderid[]">
                            @foreach($ilrfolder as $ilrfolderData)
                            <option value="{{$ilrfolderData->id}}">
                                {{ $ilrfolderData->name }}</option>

                            @endforeach
                        </select>
                           
                        </div>
                           
                    </div> 
                
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>                           
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(function () {
        $('body').on('click', '#editCompany', function (event) {
    //        debugger;
  $("#editors").html('');
 $("#contactemail").val('');
            var id = $(this).data('id');
     debugger;
            $.ajax({
                type: "GET",

                url: "{{ url('assigned/userlist') }}",
                data: "id=" + id,
                success : function(res){
           // alert(res);
            $('#out_id').html(res);

            
        },
                error: function () {

                },
            });
        });
    });

</script>