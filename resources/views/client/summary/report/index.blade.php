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
                <small>Report List</small>
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
                        <form action="{{ route('client.search') }}" method="Get">
                                    
                          <div class="row row-sm">
                          <div class="col-3">
                 <div class="form-group">
                    <label class="font-weight-600">Folder <span class="tx-danger">*</span></label>
                    <select class="form-control" id="category" name="ilrfolderid" >
        
                        <option value="">Please Select One</option>
                        @foreach($ilrfoldername as $ilrfolderData)
                        <option value="{{$ilrfolderData->id}}">
                            {{ $ilrfolderData->name }}</option>
        
                        @endforeach
                    </select>
               </div>
               </div>
               <div class="col-3">
                 <div class="form-group">
                    <label class="font-weight-600">Subfolder <span class="tx-danger">*</span></label>
                   <select class="form-control" id="subcategory_id" name="subfolderid"
               > 
            </select>
               </div>
               </div>
                          <div class="col-2">
                          <div class="form-group">
                            <label class="font-weight-600">Start Date</label>
                                <input type="date" name="startdate"  class="form-control">   
                         </div>
                    </div>
                    <div class="col-2">
                 <div class="form-group">
                    <label class="font-weight-600">End Date</label>
                    <input type="date" name="enddate" class="form-control">   
               </div>
               </div>
               <div class="col-2" style="margin-top: 12px;">
             <br>
               <div class="form-group">
                  <!-- <button type="submit" class="btn btn-success" style="float:center"> Submit</button>    -->
                  <button type="submit" class="fa fa-search btn btn-success"></button>   
            </div>
             </div>
              </div>
             </form>
              <br>
                       
            <div class="table-responsive">
                <table id="example" class="table display table-bordered table-striped table-hover">
                    <thead>
                       
                        <tr>
                            <th>Sub Folder</th>
                            <th>Question</th>
                            <th>Attachment</th>
                            <th>Remark</th>
                            <th>Uploadeded By</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($ilrfolder == null)

                      @else
                      @foreach($ilrfolder as $ilrfolderData)
                      <tr>
                          <td><a href="{{url('view/timesheet', $ilrfolderData->id)}}">{{ $ilrfolderData->name ??''}}
                          </td>
                          <td>{{ $ilrfolderData->question ??''}}
                          <td>{{ $ilrfolderData->url ??''}}
                          </td>
                          <td>{{$ilrfolderData->remark ??''}}</td>
                          <td>{{$ilrfolderData->clientname ??''}}</td>
                          <td>{{ date('F d,Y', strtotime($ilrfolderData->created_at ??'')) }}</td>
                          </tr>
                          @endforeach
                      @endif
                       
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
