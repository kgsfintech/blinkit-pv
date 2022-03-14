@extends('client.layouts.layout') @section('client_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/client/clientuserlogin/create/')}}">Add Stafflogin</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Staff Login List</small>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>phoneno</th>
                            <th>permission</th>
                            <th>Status</th>
                            <th>Reset Pswd</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientloginDatas as $clientloginData)
                        <tr>
                             <td>{{$clientloginData->name }}</td>
                            <td>{{$clientloginData->email }}</td>
                            <td>{{$clientloginData->phoneno }}</td>
                            <td>@if($clientloginData->permission==2)
                                <span>limited ( {{$clientloginData->limitedaccess }})</span>
                                @else
                                <span>unlimited </span>
                                @endif</td>
<td> <input type="checkbox" class="toggle-class" data-id="{{$clientloginData->id}}" checked="" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Active"
    data-off="InActive" {{ $clientloginData->status ? 'checked' : '' }}></td>
                            {{-- <td> <input data-id="{{$clientData->id}}" class="toggle-class" type="checkbox"
                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                    data-off="InActive" {{ $clientData->status ? 'checked' : '' }}>
                            </td> --}}
						
                            <td> <a href="{{url('/client/clientuserlogin/resetpassword/'.$clientloginData->id)}}"
                                    class="btn btn-info-soft btn-sm"><i class="fas fa-unlock-alt"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!--/.body content-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>

<script>
    $(function() {
   $('.toggle-class').change(function() {
       var status = $(this).prop('checked') == true ? 1 : 0; 
       var user_id = $(this).data('id'); 
        
       $.ajax({
             type: "GET",
             dataType: "json",
             url: "{{ url('/changeclientloginStatus') }}",
             data: {'status': status, 'user_id': user_id},
             success: function(data){
               console.log(data.success)
             }
         });
     })
   })
 </script>
<script>
    $(function () {
        $('body').on('click', '#editCompany', function (event) {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",

                url: "{{ url('client/loginid') }}",
                data: "id=" + id,

                success: function (response) {
                    $("#clientid").val(response.id);
                },
                error: function () {

                },
            });
        });

    });

</script>
@endsection
