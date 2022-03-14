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
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover basic">
                            <thead>
                                <tr>
                                    <th>Folder</th>
                                    <th>Task Name</th>
                                    <th>Priority</th>
                                    <th>Raised By</th>
                                    <th>Description</th>
                                    <th>Raised Date</th>
                                    <th>Due Date</th>

                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($taskDatasfolder as $taskDatasquestions)
                                <tr>
                                    <td><a
                                            href="{{url('client/informationlist/'.$taskDatasquestions->id)}}">{{ $taskDatasquestions->name ??'' }}</a>
                                    </td>
                                    <td>{{ $taskDatasquestions->taskname ??'' }}</td>
                                    <td>{{ $taskDatasquestions->priority ??'' }}
                                    </td>
                                    <td>{{ App\Models\Clientlogin::select('name')->where('id',$taskDatasquestions->createdby)->first()->name ?? ''}}
                                    </td>
                                    <td>{{ strip_tags($taskDatasquestions->description) ??'' }}
                                    </td>
                                    <td>{{ date('F d,Y', strtotime($taskDatasquestions->created_at)) }}
                                    </td>
                                    <td>{{ date('F d,Y', strtotime($taskDatasquestions->duedate)) }}
                                    </td>

                                 <td>@if($taskDatasquestions->status == 0)
                                        <span class="badge badge-pill badge-info">open</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">close</span>


                                        @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <br>
                <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">

                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover basic">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Task Name</th>
                                    <th>Priority</th>
                                    <th>Raised By</th>
                                    <th>Description</th>
                                    <th>Raised Date</th>
                                    <th>Due Date</th>

                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($taskDatasquestion as $taskDatasquestions)
                                <tr>
                                    <td>{{ $taskDatasquestions->question ??'' }}
                                    </td>
                                    <td><a href="{{ url('client/view/clienttask/'.$taskDatasquestions->id)}}" >{{ $taskDatasquestions->taskname ??'' }}</a></td>
                                    <td>{{ $taskDatasquestions->priority ??'' }}</td>
                                    <td>{{ App\Models\Clientlogin::select('name')->where('id',$taskDatasquestions->createdby)->first()->name ?? ''}}
                                    </td>
                                    <td>{{ strip_tags($taskDatasquestions->description) ??'' }}
                                    </td>
                                    <td>{{ date('F d,Y', strtotime($taskDatasquestions->created_at)) }}
                                    </td>
                                    <td>{{ date('F d,Y', strtotime($taskDatasquestions->duedate)) }}
                                    </td>

                                    <td>@if($taskDatasquestions->status == 0)
                                        <span class="badge badge-pill badge-info">open</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">close</span>


                                        @endif</td>
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
