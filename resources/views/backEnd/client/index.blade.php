
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
			 @if(auth()->user()->role_id != 15)
            <li class="breadcrumb-item"><a href="{{url('client/add/'.$clientid)}}">Add Client</a></li>
			@endif
            <li class="breadcrumb-item active">+</li>
        </ol>
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
    <div class="card mb-4">
    
        <div class="card-body">
            @component('backEnd.components.alert')

            @endcomponent   
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            
                            <th>Company Name</th>
                            <th> Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Associated From</th>
                            <th>Status</th>
                         <!--   <th>Edit</th>
                            <th>Contact</th>
                            <th>Deactivate</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientDatas as $clientData)
                        <tr>

                            <td><a href="{{url('/viewclient/'.$clientData->id)}}">{{$clientData->client_name }}</a></td>
                                                        <td>{{$clientData->name }}</a></td>
                            <td>{{$clientData->mobileno }}</td>
                            <td>{{$clientData->emailid }}</td>
                         @if($clientData->associatedfrom == null)
                            <td></td>
                            @else
                            <td>{{ date('F d,Y', strtotime($clientData->associatedfrom)) }}</td>
                            @endif
                              <td>    <input data-id="{{$clientData->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $clientData->status ? 'checked' : '' }}></td>
                            {{--   <td>  <a href="{{route('client.edit', $clientData->id)}}"  class="btn btn-info-soft btn-sm"><i
                                class="far fa-edit"></i></a></td>
                            <td>  <a href="{{url('/client/contactedit/'.$clientData->id)}}"  class="btn btn-info-soft btn-sm"><i
                                class="far fa-address-book"></i></a></td> --}}
                               
                            {{--   <td> <form 
                               action="{{ route('client.destroy', $clientData->id) }}" 
                                 method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a  onclick="return confirm('Are you sure you want to deactivate this item?');" class="btn btn-danger-soft btn-sm"><i
                                class="fa fa-user-times"></i></a>
                            </form></td>--}}
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>

<script>
     $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
              type: "GET",
              dataType: "json",
              url: "{{ url('/changeStatus') }}",
              data: {'status': status, 'user_id': user_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endsection


