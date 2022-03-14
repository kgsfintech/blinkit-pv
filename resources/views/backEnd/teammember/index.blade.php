
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
	@if(Auth::user()->role_id != 18)
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('teammember/create')}}">Add Teammember</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
	@endif
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-user-add-outline"></i></div>
            <div class="media-body">
               <a href="{{url('home')}}"> <h1 class="font-weight-bold" style="color:black;">Home</h1></a>
                <small>Team List</small>
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
                <table id="example" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Team Member Name</th>
                            <th>Team Role</th>
                            <th>Mobile No</th>
                            <th>Joining Date</th>
                            <th>Email</th>
                           
                            <th>Status</th>
                         
                          <!--  <th>Deactivate</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teammemberDatas as $teammemberData)
                        <tr>
                            <td><a href="{{route('teammember.edit', $teammemberData->id)}}"> {{$teammemberData->title->title ??'' }}. {{$teammemberData->team_member}}</a></td>
                            <td>{{$teammemberData->role->rolename ??''}}</td>
                            <td>{{$teammemberData->mobile_no}}</td>
                              @if($teammemberData->joining_date == null)
                            <td></td>
                            @else
                          <td>{{ date('F d,Y', strtotime($teammemberData->joining_date)) }}</td>
                            @endif
                          
                            <td>{{$teammemberData->emailid}}</td>
                            
                             <td>    <input data-id="{{$teammemberData->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $teammemberData->status ? 'checked' : '' }}></td>
                      
                           
                          <!--   <td> <form action="{{ route('teammember.destroy', $teammemberData->id) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <a  onclick="return confirm('Are you sure you want to deactivate this item?');" class="btn btn-danger-soft btn-sm"><i
                                class="fa fa-user-times"></i></a>
                            </form></td>-->
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>

<script>
     $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
              type: "GET",
              dataType: "json",
              url: "{{ url('/changeteamStatus') }}",
              data: {'status': status, 'user_id': user_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endsection


