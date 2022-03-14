<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
@extends('client.layouts.layout') @section('client_content')

<div class="body-content">
    <div class="card mb-4">

        <div class="card-body">
            @component('backEnd.components.alert')

            @endcomponent
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Folder & Subfolder</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab"
                        aria-controls="pills-user" aria-selected="false">Question</a>
                </li>

            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                     <div class="row">
                            @foreach($ilrfolder as $ilrfolderData)
                          
                                <!--Active users indicator-->
                                <div class="col-md-6 col-lg-3">  
                                 <a  href="{{ url('client/informationlist', $ilrfolderData->id)}}">
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

                <br>
                <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">

                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover basic">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Question</th>
                                  
                                   {{-- <th>Attachment</th>
                                     <th>Uploadedby</th> --}}
                                     <th>Modify Date</th>
                                    <th>Status</th>
                                    @if($permission != null)
                                    @if($permission->deletes == 1)
                                    <th>Action</th>
                                    @endif
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($informationresourcesDatas as $information => $informationresourcesData)
                                <tr>
                                    <td><a     @if(Auth::user()->id == 16 || Auth::user()->id == 44 || Auth::user()->id == 36) data-toggle="modal"  id="editCompany" data-id="{{ $informationresourcesData->id }}" data-target="#exampleModal11" @endif>{{$information  + 1 }}</a></td>
                                {{--    <td><a href="{{url('/client/informationlist/create/'.$informationresourcesData->ilrfolder_id )}}" >{{$informationresourcesData->question }}</a></td> --}}
                              
                                <td>    <a data-toggle="modal" style="color: green" id="editCompany" data-id="{{ $informationresourcesData->id }}" data-target=".bd-example-modal-lg">{{$informationresourcesData->question ??''}}</a></td>
                                  {{--  <td><a target="blank"
                                        href="{{ url('storage/app/backEnd/image/document/'. $informationresourcesData->document) }}">
                                        {{$informationresourcesData->document??''}}</a></td> 
                                           <td>{{$informationresourcesData->team_member ??''}}</td>--}}
                                            @if($informationresourcesData->updated_at != null) <td>
                                    {{ date('F d,Y', strtotime($informationresourcesData->updated_at)) }}</td>@else<td></td>@endif
                                    <td> @if(Auth::user()->id == 16 || Auth::user()->id == 36)
                                        <a  data-toggle="modal" style="color: green" id="editStatus" data-id="{{ $informationresourcesData->id }}" data-target="#exampleModal2">
                                            @endif    @if(Auth::user()->client_id == 72) @if($informationresourcesData->status==0)
                                        <span class="badge badge-pill badge-warning">pending</span>
                                        @elseif($informationresourcesData->status==2)
                                        <span class="badge badge-pill badge-info">partially received</span>
                                              @elseif($informationresourcesData->status==3)
                                        <span class="badge badge-pill badge-primary">partially uploaded</span>
                                              @elseif($informationresourcesData->status==4)
                                        <span class="badge badge-pill badge-secondary">uploaded</span>
                                             @elseif($informationresourcesData->status==5)
                                        <span class="badge badge-pill badge-danger">Not Applicable</span>
                                        @else
                                        <span class="badge badge-pill badge-success">received</span>
                                        @endif
                                        @endif
                                        @if(Auth::user()->id == 16 || Auth::user()->id == 36) </a>
                                        @endif
                                     
                                        @if(Auth::user()->client_id != 72)
                                        @if($informationresourcesData->status==0)
                                        <span class="badge badge-pill badge-warning">pending</span>
                                        @else
                                        <span class="badge badge-pill badge-success">received</span>
                                        @endif
                                         @endif
                                    </td>
                                    @if ($permission != null)
                                    
                                    @if($permission->deletes == 1)
                                    <td> <a href="{{url('/client/informationq/destroy/'.$informationresourcesData->id)}}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger-soft btn-sm"><i
                                        class="far fa-trash-alt"></i></a></td>
                                        @endif
                                            
                                    @endif
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div>
                </div>
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
        <script>
            $(document).ready(function () {
                $('#examplee').DataTable({
                    dom: 'Bfrtip',
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
