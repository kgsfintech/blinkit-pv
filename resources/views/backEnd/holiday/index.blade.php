@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('holiday/create')}}">Add Holidays</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Holidays
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
                             <th>Name</th>
                            <th>Start Date</th>
                            <th>Description</th>
                             <th>Delete</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holidayDatas as $holidayDatas)
                        <tr>
                       
                        <td><a href="{{route('holiday.edit', $holidayDatas->id)}}"> {{ $holidayDatas->holidayname }}</td>
                        <td>{{ date('F d,Y', strtotime($holidayDatas->startdate)) }}</td> 
                        <td>{{ $holidayDatas->description }} </td>
                              
                        <td> <a href="{{url('holiday/delete',$holidayDatas->id)}}"
                                        class="btn btn-info-soft btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!--/.body content-->
@endsection
