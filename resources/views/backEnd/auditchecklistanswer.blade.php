@extends('backEnd.layouts.layout') @section('backEnd_content')
<style>
    .example:hover {
        overflow-y: scroll;
        /* Add the ability to scroll */

    }
 .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused){
height: 300px;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .example {
       height: 200px;
        margin: 0 auto;
        overflow: hidden;
    }

</style>
<div class="body-content">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header" style="background-color: #36ce1a4f;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0"><i class="far fa-edit"></i> Checklist Task Answer
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <fieldset class="form-group">
                        <table class="table display table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td><b>Financial Statement Classification Name :</b></td>
                                    <td>{{ $auditchecklistAnswer->financial_name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Sub Financial Classfication Name :</b></td>
                                    <td>{{ $auditchecklistAnswer->subclassficationname}}</td>
                                </tr>
                                <tr>
                                    <td><b>Steplist Name :</b></td>
                                    <td>{{$auditchecklistAnswer->stepname}}</td>

                                </tr>
                                <tr>
                                    <td><b>Status :</b></td>
                                    <td>@if($checklistanswer)
                                         @if($checklistanswer->status==2)
                                        <span class="badge badge-success">SUBMITTED</span>
                                        @elseif($checklistanswer->status==3)
                                        <span class=" badge badge-warning">REVIEW-TL</span>
                                        @elseif($checklistanswer->status==4)
                                        <span class=" badge badge-danger">CLOSE</span>
                                        @else
                                        <span class="badge badge-primary">OPEN</span>
                                        @endif
                                        @else
                                        <span class="badge badge-primary">OPEN</span>
                                        @endif

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="row row-sm">
                         <div class="col-6">
                            <div class="form-group">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0">Question :
                                        <small>{{$auditchecklistAnswer->auditprocedure}}</small> </h6>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div>
                                   <a href="{{url('/criticalnotes?'.'auditid='.$auditchecklistAnswer->id.'&&'.'assignmentid='.$assignmentgenerateid)}}"  ><span style="color:red;float:right;"><b>Add Critical Notes </b></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ url('auditchecklistanswer/store')}}" enctype="multipart/form-data">
                        @csrf
                        @component('backEnd.components.alert')

                        @endcomponent
                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea rows="14" name="answer" value="" class="centered form-control"  id="editor"
                                        placeholder="Enter Checklist Answer">{!! $checklistanswer->answer ??'' !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="font-weight-600"><b style="color: yellowgreen;">Checklist Notes
                                            :</b></label>
                                    <textarea rows="9" name="checklist_note" value=""
                                        class="form-control">{!! $checklistanswer->checklist_note ??'' !!}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="font-weight-600"><b>Audit Trail :</b></label>
                                    <div class="card mb-4" style="height: 203px;">
                                        <div class="list-group list-group-flush">
                                            <ul class="list-unstyled example" >
                                                @if(count($checklistanswertrail)>0)
                                                @foreach($checklistanswertrail as $checklistanswertrailData)
                                                <li class="list-group-item list-group-item-action ">
                                                    <h5><span
                                                            style="color:#007bff;font-size: small;">{{$checklistanswertrailData->team_member}}
                                                        </span>
                                                        <small>{{$checklistanswertrailData->desc}} </small>
                                                    </h5>
                                                    <small class="text-muted"><i class="far fa-clock mr-1"></i>
                                                        {{ date('H:i A', strtotime($checklistanswertrailData->created_at)) }},
                                                        {{ date('F jS', strtotime($checklistanswertrailData->created_at)) }}</small>
                                                </li>
                                                @endforeach
                                                @else
                                                <li class="list-group-item list-group-item-action">
                                                    <br><br><br>
                                                    <h5 style="text-align: center"><span>No Data</span></h5>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <br>
                                    <label class="font-weight-600"><b>Reference Document :</b></label>
                                    <span> <input type="file" multiple name="refdocument[]" />
                                        <input type="text" hidden name="audit_id" value="{{$auditchecklistAnswer->id}}"
                                            class="form-control">
                                        <input type="text" hidden name="steplist_id"
                                            value="{{$auditchecklistAnswer->steplist_id}}" class="form-control">
                                        <input type="text" hidden name="subclassfied_id"
                                            value="{{$auditchecklistAnswer->subclassfied_id}}" class="form-control">
                                        <input type="text" hidden name="financialstatemantclassfication_id"
                                            value="{{$auditchecklistAnswer->financialstatemantclassfication_id}}"
                                            class="form-control">
                                            <input type="text" hidden name="assignment_id" value="{{$assignmentgenerateid}}"
                                            class="form-control">
                                            <input type="text"  id="tussenstand" hidden name="status" value=""
                                            class="form-control">
                                    </span>
                                </div>
                            </div>
                           <div class="col-1"><br><br>
                                @if(count($checklistfile) < 1)
                                <div class="form-group">
                                    <a data-toggle="modal" data-target="#exampleModal1" 
                                        style="float:right"></a>
                                </div>
                              @else
                              <div class="form-group">
                                <a data-toggle="modal" data-target="#exampleModal1" 
                                    style="float:right">View</a>
                            </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row row-sm">
                         
                            @if($authteamid != null)
                              @if(empty($checklistanswer->status) || $checklistanswer->status == 1)
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="1" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="2" type="submit" class="btn btn-primary">Submitted</button>
                                </div>
                            </div>
                            @endif
                            @endif
                            @if($authteamtl != null)
                            @if(empty($checklistanswer->status) || $checklistanswer->status == 1)
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="1" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="2" type="submit" class="btn btn-primary">Submitted</button>
                                </div>
                            </div>
                            @elseif($checklistanswer->status  == 2 || $checklistanswer->status  == 3)
                            <div class="col-2">
                        <div class="form-group" style="text-align: center">
                            <label class="font-weight-600"></label>
                            <button value="1" type="submit" class="btn btn-success">ReOpen</button>
                        </div>
                            </div>
                            <div class="col-2">
                        <div class="form-group" style="text-align: center">
                            <label class="font-weight-600"></label>
                            <button value="3" type="submit" class="btn btn-primary">Review</button>
                        </div>
                            </div>
                            @else
                            @endif
                        @endif
                            @if($authpartnerid != null)
                            @if(empty($checklistanswer->status) || $checklistanswer->status == 1)
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="1" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="2" type="submit" class="btn btn-primary">Submitted</button>
                                </div>
                            </div>
                            @elseif($checklistanswer->status  == 2)
                            <div class="col-2">
                        <div class="form-group" style="text-align: center">
                            <label class="font-weight-600"></label>
                            <button value="1" type="submit" class="btn btn-success">ReOpen</button>
                        </div>
                            </div>
                            <div class="col-2">
                        <div class="form-group" style="text-align: center">
                            <label class="font-weight-600"></label>
                            <button value="3" type="submit" class="btn btn-primary">Review</button>
                        </div>
                            </div>
                            @elseif($checklistanswer->status  == 3)
                             <div class="col-2">
                        <div class="form-group" style="text-align: center">
                            <label class="font-weight-600"></label>
                            <button value="1" type="submit" class="btn btn-success">ReOpen</button>
                        </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="4" type="submit" class="btn btn-primary">Close</button>
                                </div>
                            </div>
                            @else
                            <div class="col-2">
                                <div class="form-group" style="text-align: center">
                                    <label class="font-weight-600"></label>
                                    <button value="4" type="submit" class="btn btn-primary">Close</button>
                                </div>
                            </div>
                            @endif
                            @endif   
                            <div class="col-2">
                            </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('viewassignment/contactupdate') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="exampleModalLabel4">Audit File List</h5>
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
                    <div class="table-responsive">

                        <table class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Uploaded by</th>
                                    <th>File</th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach($checklistfile as $checklistfiledata)
                                <tr>
                                    <td>{{$checklistfiledata->refdocument }}</td>
                                    <td>{{$checklistfiledata->team_member }}</td>
                                    @if (pathinfo($checklistfiledata->refdocument, PATHINFO_EXTENSION) == 'png')
                                    <td><a class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-file" style="margin-right: 4px;"></i>Open</a> <a
                                            class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-download" style="margin-right: 4px;"></i>Download</a></td>
                                    @elseif(pathinfo($checklistfiledata->refdocument, PATHINFO_EXTENSION) == 'jpeg')
                                    <td><a class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-file" style="margin-right: 4px;"></i>Open </a> <a
                                            class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-download" style="margin-right: 4px;"></i>Download</a></td>
                                    @elseif(pathinfo($checklistfiledata->refdocument, PATHINFO_EXTENSION) == 'jpg')
                                    <td><a class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-file" style="margin-right: 4px;"></i>Open </a> <a
                                            class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-download" style="margin-right: 4px;"></i>Download</a></td>
                                    @else
                                    <td><a class="btn btn-primary btn" target="blank"
                                            href="https://docs.google.com/gview?url={{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-file-excel" style="margin-right: 4px;"></i>Open</a> <a
                                            class="btn btn-success btn" target="blank"
                                            href="{{ Storage::disk('s3')->temporaryUrl('checklistansfile/'.$checklistfiledata->refdocument, now()->addMinutes(2)) }}"><i
                                                class="fas fa-download" style="margin-right: 4px;"></i>Download</a></td>
                                    @endif
                                  

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script><script src="{{ url('backEnd/ckeditor/ckeditor.js')}}"></script>

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
<script>
var theTotal = 0;
$('button').click(function(){
   theTotal = Number(theTotal) + Number($(this).val());
    $('#tussenstand').val(+theTotal);        
});

$('#tussenstand').val(+theTotal);
</script
@endsection
