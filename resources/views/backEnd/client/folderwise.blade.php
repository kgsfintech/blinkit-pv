
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
		 @if(auth()->user()->role_id != 15)
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
			
            <li class="breadcrumb-item"><a href="{{url('client/create')}}">Add Client</a></li>
			
            <li class="breadcrumb-item active">+</li>
		
        </ol>
			@endif
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Client
                List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
            @component('backEnd.components.alert')

            @endcomponent   
          <div class="row">
                        @foreach($clientDatas as $clientData)
                      
	    <div class="col-md-6 col-lg-3">
            <!--Active users indicator-->
            <a  href="{{url('/viewclient/'.$clientData->id)}}">
            <div class="p-2  text-white rounded mb-3 p-3 shadow-sm text-center" style="background: @if($loop->iteration % 2 == 0) #06386A;  @else #37A000; @endif ">
                <div class="header-pretitle fs-11 font-weight-bold text-uppercase" style="color: white"></div>
				
                <div class="fs-32 text-monospace"><i class="fas fa-users"></i></div>
                <small style="font-size: 13px;">{{$clientData->client_name}}</small>
				
            </div>
            </a>
	</div>
                      @endforeach
	</div>
      

</div><!--/.body content-->

@endsection


