@extends('client.layouts.layout') @section('client_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            </li>
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Summary List</small>
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
                            <th>Folder</th>
                            <th>Sub Folder</th>
                            <th>Question</th>
                            <th>Attachment</th>
                            <th>Remark</th>
                            <th>Uploadeded By</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                      @foreach($ilrfolder as $ilrfolderData)
                      <tr>
                        <td><a href="{{url('client/informationquestion/particular', $ilrfolderData->id)}}">{{ $ilrfolderData->ilrfoldersname ??''}}</a>
                          <td>{{ $ilrfolderData->name ??''}}
                          </td>
                          <td>{{ $ilrfolderData->question ??''}}
                          <td>{{ $ilrfolderData->url ??''}}
                          </td>
                          <td>{{$ilrfolderData->remark ??''}}</td>
                          <td>{{$ilrfolderData->clientname ??''}}</td>
                          <td>{{ date('F d,Y', strtotime($ilrfolderData->created_at ??'')) }}</td>
                          <td>@if($ilrfolderData->status==0)
                            <span class="badge badge-info">Open</span>
                         
                            @else
                            <span class="badge badge-danger">Close</span>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function(){
       $('#category').on('change',function(){
           var category_id =$(this).val();

        $.ajax({
            type: "GET",
            url: "{{ url('client/report') }}",
            data: "category_id="+category_id,
            success : function(res){
            
                $('#subcategory_id').html(res);

                
            },
            error : function(){

            },
        });
       });
     }); 
 </script>
