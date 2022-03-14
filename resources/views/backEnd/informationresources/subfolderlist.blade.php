
@extends('backEnd.layouts.layout') @section('backEnd_content')
<style>
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
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}" >Back <i class="fa fa-reply"></i></a></li>
         
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
 
   <div class="row">
        @foreach($ilrfolder as $ilrfolderData)
        <div class="col-md-6 col-lg-3">
			     @if(Auth::user()->role_id == 11 )
            <ul class="navbar-nav flex-row align-items-center ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a class="foldertoggle" style=" color:white" href="#" data-toggle="dropdown">
                        <!--<img src="assets/dist/img/user2-160x160.png" alt="">-->
                         <i class="ti-more-alt"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" style="height: 55px;">
                      <a style="margin-left: 10px;" href="{{url('/ilrsubfolder/delete/'.$ilrfolderData->id)}}" 
                         onclick="return confirm('Are you sure you want to delete this item?');" class="dropdown-item">Delete</a>
                     </div><!--/.dropdown-menu -->
                </li>
            </ul>
              @endif
            <!--Active users indicator-->
            <a  href="{{ url('informationlist', $ilrfolderData->id)}}">
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
@endsection
                             

