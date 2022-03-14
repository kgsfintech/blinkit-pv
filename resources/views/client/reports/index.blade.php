<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
@extends('client.layouts.layout') @section('client_content')
<style>
    a{
        cursor: pointer;
    }
</style>
<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small></small>
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
                            {{-- <th style="display: none;">id</th> --}}
                            {{-- <th style="padding-right: 0px;">Folder</th> --}}
                            <th style="padding-right: 0px;">Location</th>
							<th style="padding-right: 0px;">Store Code</th>
							<th style="padding-right: 0px;">Address</th>
							<th style="padding-right: 0px;">Store Type</th>
                            {{-- <th style="padding-right: 0px;">Upload asset information</th>
                            <th style="padding-right: 0px;">upload tagging information</th>
                            <th style="padding-right: 0px;">upload closure report</th> --}}
                            @foreach($ilrfolderquestion as $ilrfolderquestionData)
                            <th style="padding-right: 0px;">{{ $ilrfolderquestionData->question ??''}}</th>
                            @endforeach
                            {{--                          
                            <th style="padding-right: 0px;">Remark</th>
                            <th style="padding-right: 0px;">Uploadeded By</th> --}}
                            {{-- <th>Modify Date</th> --}}

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($ilrfolder as $ilrfolderData)
                        <tr>
                            {{-- <td style="display: none;">{{$ilrfolderData->id }}</td> --}}
                            {{-- <td><a  href="{{url('client/informationlist', $ilrfolderData->ilrfoldersid)}}"
                            >{{ $ilrfolderData->ilrfoldersname ??''}}</a> </td> --}}
                            <td>
							
                                <a>{{ $ilrfolderData->name ??''}}</a>
                            </td>
							<td>{{ $ilrfolderData->store_code ??''}}</td>
							<td>{{ $ilrfolderData->address ??''}}</td>
							<td>{{ $ilrfolderData->store_type ??''}}</td>
                            @php

                            $ilrfolders = DB::table('ilranswers')
                            ->where('ilranswers.informationresource_id',$ilrfolderData->id)
                            ->where('ilranswers.questionid',1)
                            ->first();
                           // dd();
                            $ilrfolders2 = DB::table('ilranswers')
                            ->where('ilranswers.informationresource_id',$ilrfolderData->id)
                            ->where('ilranswers.questionid',2)
                            ->first();
                         //   dd($ilrfolderData->subid);
                            $ilrfolders3 = DB::table('ilranswers')
                            ->where('ilranswers.informationresource_id',$ilrfolderData->id)
                            ->where('ilranswers.questionid',3)
                            ->first();
                            //dd($ilrfolders);
                            @endphp
                            @if($ilrfolders == null)
                            <td><a data-toggle="modal" style="color: green" id="{{ $ilrfolderData->id }}"
                                    onClick="reply_click(this.id,1)" data-target="#exampleModal11"><span
                                        class="badge badge-pill badge-warning"> Upload File</span></a></td>
                            @else
                            <td><a data-toggle="tooltip" title="{{ $ilrfolders->remark }}" class="btn btn-success"
                                    href="{{ Storage::disk('s3')->temporaryUrl('clientinfodocument/'.$ilrfolders->url, now()->addMinutes(10)) }}"><i
                                        class="fas fa-download"></i> Download</a></td>
                            @endif
                            @if($ilrfolders2 == null)
                            <td><span class="badge badge-pill badge-warning">Pending</span></td>
                            @else
                            <td><a data-toggle="tooltip" title="{{ $ilrfolders2->url }}" class="btn btn-success"
                                href="{{ Storage::disk('s3')->temporaryUrl('clientinfodocument/'.$ilrfolders2->url, now()->addMinutes(10)) }}"><i
                                    class="fas fa-download"></i> Download</a></td>
                            @endif
                            @if($ilrfolders3 == null)
                             <td><span class="badge badge-pill badge-warning">Pending</span></td>
                            @else
                            <td><a data-toggle="tooltip" title="{{ $ilrfolders3->url }}" class="btn btn-success"
                                    href="{{ Storage::disk('s3')->temporaryUrl('clientinfodocument/'.$ilrfolders3->url, now()->addMinutes(10)) }}"><i
                                        class="fas fa-download"></i> Download</a></td>
                            @endif

                            {{-- <td> <a  href="{{ Storage::disk('s3')->temporaryUrl('clientinfodocument/'.$ilrfolderData->url, now()->addMinutes(30))}}">{{ $ilrfolderData->url ??''}}</a>
                            </td> --}}
                            {{-- <td>@if($ilrfolderData->created_at !=  null )
                            {{ date('F d,Y', strtotime($ilrfolderData->created_at ??'')) }}@else @endif</td> --}}

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!--/.body content-->
<div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('/client/summary/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background: #37A000">
                    <h5 style="color: white" class="modal-title font-weight-600" id="exampleModalLabel4">Add Document</h5>
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
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">File :</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="file" type="file">
                            <input id="editilrid" hidden class="form-control" name="ilrid" type="text">
                            <input id="questionid" hidden class="form-control" name="questionid" type="text">
                        </div>

                    </div>
					 <div class="details-form-field form-group row">
                            <label for="address" class="col-sm-3 col-form-label font-weight-600">Sample Excel:</label>
                            <div class="col-sm-9">
                                <a href="{{ url('backEnd/storeformat.xlsx')}}" 
                                class="btn btn-success btn"  >Download<i class="fas fa-file-excel" style="margin-left: 3px;font-size: 20px;"></i></a>
                           
                                </div>
                            </div>
                    {{-- <div class="details-form-field form-group row">
                        <label for="name" class="col-sm-3 col-form-label font-weight-600">Remark :</label>
                        <div class="col-sm-9">
                            <textarea rows="3" name="remark" class="form-control"
                                placeholder="Enter Remarks"></textarea>
                        </div>

                    </div> --}}

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function reply_click(clicked_id,value) {
      //  alert(value);
      document.getElementById('questionid').value = value;
        document.getElementById('editilrid').value = clicked_id;
    }

</script>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#exampleee').DataTable({
            "order": [
                [0, "desc"]
            ],

            buttons: [

                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
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
                        columns: [0, 1, 2, 5]
                    }
                },
                'colvis'
            ]
        });
    });

</script>
