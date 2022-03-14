<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
@extends('client.layouts.layout') @section('client_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
           <a href="{{ url('client/home/') }}">Back <i
                        class="fa fa-reply"></i></a>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Particular List</small>
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
                <table id="exampleee" class="display">
                    <thead>
                       
                        <tr>
                            <th style="display: none;">id</th>
                            <th style="padding-right: 0px;">Particular</th>
                            <th style="padding-right: 0px;">Question</th>
                            <th style="padding-right: 0px;">Raised Date</th>
                            <th style="padding-right: 0px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                      @foreach($ilrfolder as $ilrfolderData)
                      <tr>
                        <td style="display: none;">{{$ilrfolderData->id }}</td>
                        <td> <a  href="{{url('client/informationquestion/particular', $ilrfolderData->id)}}" >
                            {{ $ilrfolderData->particular }}</a>
                          <td > <a  href="{{url('client/informationlist', $ilrfolderData->ilrfolder_id)}}" >{{ $ilrfolderData->question }}</a>
                          </td>
                          <td>{{ date('F d,Y', strtotime($ilrfolderData->created_at ??'')) }}</td>
                          <td> @if($ilrfolderData->status==0)
                            <span class="badge badge-pill badge-warning">Open</span>
                         
                                 @else
                            <span class="badge badge-pill badge-danger">Close</span>
                           
                            @endif</td>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>                               
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>                               
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>                               
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>                               
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>                               
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>                               
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>                               
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>    
<script>$(document).ready(function() {
    $('#exampleee').DataTable( {
        "order": [[ 0, "desc" ]],
        
        buttons: [
            
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'      
    ]  
    } );
} );</script>                                

