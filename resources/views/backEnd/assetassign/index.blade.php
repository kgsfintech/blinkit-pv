@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    @if(Auth::user()->role_id == 16)
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#exampleModal1">Add Excel</a></li>
            <li class="breadcrumb-item active">+</li>

        </ol>
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('assetassign/create')}}">Add finance</a></li>
            <li class="breadcrumb-item active">+</li>
        </ol>

    </nav>
    @endif
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Finance
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
                   <table id="example" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Sno</th>
                            <th>Company Name</th>
                            <th>Kgs</th>
                            <th>Name</th>
                            <th>acknowledge</th>
                            <th>Asset Status</th>
                           


                            <th>Finance Status</th>
                            @if(Auth::user()->role_id == 16)
                            <th>Edit</th>

                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($financeDatas as $financeData)
                        <tr>
                            <td> <a href="{{ url('/assetassigned/view', $financeData->id)}}">
                                    {{$financeData->modal_name }}</a></td>
                            <td>{!! $financeData->sno !!}</td>
                            <td>{!! $financeData->company_name !!}</td>
                            <td>{!! $financeData->kgs !!}</td>
                            <td>{{ App\Models\Teammember::select('team_member')->where('id',$financeData->teammemberid)->first()->team_member ?? ''}}
                            </td>
                            <td> @if($financeData->acknowledge==0)
                                <span class="badge badge-warning">Not Acknowledge</span>
                                @else
                                <span class="badge badge-success">Acknowledge</span>
                                @endif
                            </td>
                            @if($financeData->teammemberid !=null)
                            <td> @if($financeData->assetstatus == 0 )
                                <span class="badge badge-success">Assigned</span>
  @elseif($financeData->assetstatus == 2 )
                                <span class="badge badge-warning">Discard</span>
                                @else
                                <span class="badge badge-danger">Return</span>
                                @endif
                            </td>
                            @else
                            <td></td>
                            @endif
                           

                            <td> @if($financeData->status==1)
                                <span class="badge badge-success">Approved</span>
                                @elseif($financeData->status==2)
                                <span class=" badge badge-danger">Reject</span>
                                @elseif($financeData->status==3)
                                <span class=" badge badge-info">Created</span>
                                @else
                                <span class="badge badge-primary">Pending</span>
                                @endif</td>
                                @if(Auth::user()->role_id == 16)

                            <td> <a href="{{route('assetassign.edit', $financeData->id)}}"
                                    class="btn btn-info-soft btn-sm"><i class="far fa-edit"></i></a></td>
                         

                            <td> <a href="{{ url('/assetassign/viewit', $financeData->id)}}" class="btn btn-success">
                                    request</a></td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!--/.body content-->
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('assetassign/upload')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="exampleModalLabel4">Add Excel</h5>
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
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Upload Excel:</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="file" type="file">
                        </div>

                    </div>

                    <div class="details-form-field form-group row">
                        <label for="address" class="col-sm-3 col-form-label font-weight-600">Sample Excel:</label>
                        <div class="col-sm-9">
                            <a href="{{ url('backEnd/financeimport.xlsx')}}" class="btn btn-success btn">Download<i
                                    class="fas fa-file-excel" style="margin-left: 3px;font-size: 20px;"></i></a>

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
@endsection
