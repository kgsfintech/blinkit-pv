@extends('client.layouts.layout') @section('client_content')
<style>
    .example:hover {
        overflow-y: scroll;
        /* Add the ability to scroll */

    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .example {
       height: 180px;
        margin: 0 auto;
        overflow: hidden;
    }

</style>
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-12 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('client/particularindex/') }}">Back <i
                        class="fa fa-reply"></i></a></li>
          
        </ol>
    </nav>
   
</div>
<div class="body-content">
    <div class="mailbox">
        <div class="mailbox-body">
            <div class="row m-0">
                <div class="col-lg-3 p-0 inbox-nav d-none d-lg-block">
                    <div class="mailbox-sideber">
                        <div class="card-header"
                            style="margin-top: -15px;margin-left: -15px;width: 114%;background: #37A000;color: white;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="row">
                                    <h6 class="fs-17 font-weight-600 mb-0">Particular </h6>
                                  <!-- <a data-toggle="tooltip"
                                        style="background: aliceblue;margin-left: 9px;margin-top: -4px;"
                                        title="only for delete within 6 hours"
                                        href="{{url('/client/mis/destroy/')}}"
                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                        class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a> -->

                                        
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush example" style="height: 440px;">
                                <ul class="list-unstyled " >
                                    @if(count($ilrlog)>0)
                                    @foreach($ilrlog as $ilrlogData)
                                    <li class="list-group-item list-group-item-action " >
                                        <h5>
                                            <small>{{$ilrlogData->description}} </small>
                                            <span
                                                style="color:#007bff;font-size: small;">{{$ilrlogData->team_member}}
                                            </span>
                                            <span
                                                style="color:#007bff;font-size: small;">{{$ilrlogData->name ??''}}
                                            </span>
                                        </h5>
                                        <small class="text-muted"><i class="far fa-clock mr-1"></i>
                                            {{ date('h:i a', strtotime($ilrlogData->created_at)) }},
                                            {{ date('F jS', strtotime($ilrlogData->created_at)) }}</small>
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

                <div class="col-md-12 col-lg-9 p-0 inbox-mail">
                    @component('backEnd.components.alert')

                    @endcomponent
                    <div class="inbox-avatar-wrap p-3 border-btm d-sm-flex"
                        style="color: white;margin-top: -21px;background: #37A000;">
                        {{-- <div class="inbox-avatar-text ml-sm-3 mb-2 mb-sm-0">
<div class="avatar-name" style="color: white;"><strong></strong>
#{{ $ticketDatas->generateticket_id}} -- {{ $ticketDatas->subject}}
                    </div>

                </div> --}}
                <div class="inbox-date ml-auto" style="margin-top: 17px;">
                    
                    <div><small>{{ date('F jS', strtotime($viewinfo->created_at)) }},
                            {{ date('H:i A', strtotime($viewinfo->created_at)) }}</small></div>
                
                    <div></div>
                </div>
            </div>


            <div class="inbox-mail-details p-3">
                <div class="row">
                    <div class="card" style="width: 100%;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2)">
                        <div class="inbox-avatar-wrap p-3 border-btm d-sm-flex">
                            <div class="inbox-avatar-text ml-sm-3 mb-2 mb-sm-0">
                                <div class="avatar-name"><strong></strong>
                                    
                                    <b style="font-size: 15px;"> {{ $viewinfo->particular ??''}}</b>
                                </div>
                                <p><i class="fas fa-file"> {{ $viewinfo->url }}</i></p>
                            </div>
                            <div class="inbox-date ml-auto">
                                <div><span class="badge badge-info"></span></div>
                                <div><small></small>
                                </div>
                            </div>
                            <div class="inbox-date ml-auto">
                                <div><small>{{ date('F jS', strtotime($viewinfo->created_at)) }},
                                        {{ date('h:i A', strtotime($viewinfo->created_at)) }}</small>
                                </div>
                            </div>
                        </div>
                        @foreach($infoparticulars as $infoparticularsData)
                        <div class="inbox-avatar-wrap p-3 border-btm d-sm-flex">
                            <div class="inbox-avatar-text ml-sm-3 mb-2 mb-sm-0">
                                <div class="avatar-name"><strong></strong>
                                    
                                    <b> {{ $infoparticularsData->name ??''}}</b>
                                </div>
                                <p>{!! $infoparticularsData->remark !!}</p>
                            </div>
                            <div class="inbox-date ml-auto">
                                <div><span class="badge badge-info"></span></div>
                                <div><small></small>
                                </div>
                            </div>
                            <div class="inbox-date ml-auto">
                                <div><span >@if($infoparticularsData->status==0)
                                    <span class="badge badge-info">Open</span>
                                 
                                    @else
                                    <span class="badge badge-danger">Close</span>
                                    @endif</span></span></div>
                                <div><small>{{ date('F jS', strtotime($infoparticularsData->created_at)) }},
                                        {{ date('h:i A', strtotime($infoparticularsData->created_at)) }}</small>
                                </div>
                            </div>
                        </div>
                       @endforeach
                       
                        <div class="mt-3 p-3">
                            <form method="post" action="{{ url('client/info/update')}}"
                                enctype="multipart/form-data">
                                @csrf

                                <p><textarea class="centered form-control"
                                        rows="3" name="remark" value="" placeholder="Enter doubts"></textarea><br>
                                    <div class="row">
                                        <div class="col-4">
                                            <select name="status" class="form-control">
                                                <!--placeholder-->
                                            
                                                <option value="">Please Select One</option>
                                                <option value="0">Open</option>
                                                <option value="1">Close</option>
                                            </select>
                                            <input type="text" hidden name="infono" value="{{ $id }}">
                                        </div>
                                        <div class="col-4">
                                           
                                            <input type="text" hidden name="missno" value="">
                                        </div>
                                       
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-success" style="float:right">
                                                Submit</button></div>
                                    </div>
                                </p>
                            </form>
                        </div>
                      
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
</div>

</div>
<!--/.body content-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #37A000">
                <h5 style="color: white" class="modal-title font-weight-600" id="exampleModalLabel4">Preview</h5>
         
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" id="attachment">
                  
                </div>
            </div>
            
           
               <span id="imgdwnld" style="text-align: center"></span>
          <br>
        </div>
    </div>
</div>
<div class="modal fade bd-examplee-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleeModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #37A000">
                <h5 style="color: white" class="modal-title font-weight-600" id="exampleModalLabel4">Prview</h5>
         
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" id="clientattachment">
                  
                </div>
            </div>
            
           
               <span id="clientimgdwnld" style="text-align: center"></span>
          <br>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(function () {
        $('body').on('click', '#editCompany', function (event) {
            var id = $(this).data('id');
     debugger;
            $.ajax({
                type: "GET",

                url: "{{ url('/client/misimage') }}",
                data: "id=" + id,

                success: function (response) {
                    var img = '<img class="img-thumbnail img-responsive" src="{{ url('/backEnd/image/mis/')}}/'+response.attachment+'" width="1000">';
                    var clientimg = '<img class="img-thumbnail img-responsive" src="{{ url('/backEnd/image/mis/')}}/'+response.clientattachment+'" width="1000">';
                    var imgdwnld = '<a download href="{{ url('/backEnd/image/mis/')}}/'+response.attachment+'"  class="btn btn-success"><i class="fa fa-download"> Download</i></a>';
                    var clientimgdwnld = '<a download href="{{ url('/backEnd/image/mis/')}}/'+response.clientattachment+'"  class="btn btn-success"><i class="fa fa-download"> Download</i></a>';
                    debugger;
                    $("#attachment").html(img);
                    $("#clientattachment").html(clientimg);
                    $("#imgdwnld").html(imgdwnld);
                    $("#clientimgdwnld").html(clientimgdwnld);
                    
                 
                },
                error: function () {

                },
            });
        });

    });

</script>
<script>
    function myFunction() {
        document.getElementById("panel").style.display = "block";
    }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ url('backEnd/ckeditor/ckeditor.js')}}"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });

</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor1'), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });

</script>
@endsection

<!--Page Active Scripts(used by this page)-->
<script src="{{ url('backEnd/dist/js/pages/forms-basic.active.js')}}"></script>
<!--Page Scripts(used by all page)-->
<script src="{{ url('backEnd/dist/js/sidebar.js')}}"></script>
