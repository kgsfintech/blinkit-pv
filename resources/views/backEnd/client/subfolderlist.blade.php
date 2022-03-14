
@extends('backEnd.layouts.layout') @section('backEnd_content')

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
                <small>ILR Folder  List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
 
   <div class="row">
        @foreach($ilrfolder as $ilrfolderData)
        <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
            <a  href="{{ url('informationlist', $ilrfolderData->id)}}">
                <div class="p-2  text-white rounded mb-3 p-3 shadow-sm text-center" style="background: @if($loop->iteration % 2 == 0) #37A000; @else #06386A; @endif">
                    <div class="header-pretitle fs-11 font-weight-bold text-uppercase" style="color: white;font-size: 11px!important;">{{ strlen($ilrfolderData->name) > 26 ? substr($ilrfolderData->name,0,26) :$ilrfolderData->name }}</div>
                    @if(count($ilrfolderData->ilr) > 0)
                    <div class="fs-32 text-monospace">{{ count($ilrfolderData->ilr) }}</div>
                    <small>IRL</small>
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
                             

