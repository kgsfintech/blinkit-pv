 <!--Third party Styles(used by this page)--> 
  <link href="{{ url('backEnd/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">
  <link href="{{ url('backEnd/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{ url('backEnd/plugins/jquery.sumoselect/sumoselect.min.css')}}" rel="stylesheet">
  
@extends('backEnd.layouts.layout') @section('backEnd_content')

<div class="body-content">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header" style="background:#37A000">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <h6 style="color:white" class="fs-17 font-weight-600 mb-0">Add Timesheet</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('timesheet.store')}}" enctype="multipart/form-data">
                        @csrf
                  @component('backEnd.components.alert')

                  @endcomponent
                        @include('backEnd.timesheet.form')
                    </form>
                   
                    <hr class="my-4">

                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="row row-sm "><div class="col-2"><div class="form-group"><label class="font-weight-600">Client Name</label><select class="language form-control" name="client_id[]" id="client"><option>Select Client</option>@foreach($client as $clientData)<option value="{{$clientData->id}}" @if(!empty($store->financial) && $store->financial==$clientData->id) selected @endif>{{$clientData->client_name }}</option>@endforeach</select></div></div><div class="col-2"><div class="form-group"><label class="font-weight-600">Project Name</label><select class="language form-control" name="project_id[]" id="key"><option>Select Project</option>@foreach($project as $projectData)<option value="{{$projectData->id}}" @if(!empty($store->financial) && $store->financial==$projectData->id) selected @endif>{{$projectData->project_name }}</option>@endforeach</select></div></div><div class="col-2"><div class="form-group"><label class="font-weight-600">Job Name</label><select class="language form-control" name="job_id[]" id="key"><option>Select Job</option>@foreach($job as $jobData)<option value="{{$jobData->id}}" @if(!empty($store->financial) && $store->financial==$jobData->id) selected @endif>{{$jobData->job_name }}</option>@endforeach</select></div></div><div class="col-1"><div class="form-group"><label class="font-weight-600" style="width:100px;">Work Item </label><input type="text" name="workitem[]" id="key" value="{{ $outstationconveyance->Audit_from_date ?? ''}}" class="form-control key"></div></div><div class="col-2"> <div class="form-group"> <label class="font-weight-600"> Billable Status </label><select class="form-control key" name="billable_status[]" id="key" value="" id="exampleFormControlSelect1" > <option value="Billable">Billable</option> <option value="Non Billable">Non Billable</option> </select> </div> </div><div class="col-1"><div class="form-group"><label class="font-weight-600">Description </label><input type="text" name="description[]" id="key" value="{{ $outstationconveyance->Audit_from_date ?? ''}}" class="form-control key"></div></div><div class="col-1"><div class="form-group"><label class="font-weight-600">Hour </label><input type="time" name="hour[]" id="key" value="{{ $outstationconveyance->Audit_from_date ?? ''}}" class="form-control key"></div></div><a style="margin-top: 36px;" href="javascript:void(0);" class="remove_button"><img src="{{ url('backEnd/image/remove-icon.png')}}"/></a></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>
    
       <script>
        $(function(){
           $('#client').on('change',function(){
               var cid =$(this).val();
           // alert(category_id);
            $.ajax({
                type: "get",
                url: "{{ url('timesheet/create') }}",
                data: "cid="+cid,
                success : function(res){
                    $('#project').html(res);
                },
                error : function(){
                },
            });
           });
         }); 
     </script>
      <script>
        $(function(){
           $('#project').on('change',function(){
               var pid =$(this).val();
        //    alert(project);
            $.ajax({
                type: "get",
                url: "{{ url('timesheet/create') }}",
                data: "pid="+pid,
                success : function(res){
                    $('#job').html(res);    
                },
                error : function(){
    
                },
            });
           });
         }); 
     </script>
    
    <script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

