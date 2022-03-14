
<div class="field_wrapper">
<!-- <div class="row row-sm">
                          <div class="col-3">
                          <div class="form-group">   
                                <input type="date" name="startdate" value="{{date('Y-m-d')}}" class="form-control">   
                         </div>
                    </div>
                    <div class="col-3">
                 <div class="form-group">
                    <input type="date" name="todate" value="{{date('Y-m-d')}}" class="form-control">   
               </div>
               </div>
               <div class="col-2">
               <div class="form-group">
                  <button type="submit" class="btn btn-success" style="float:center"> Submit</button>      
            </div>
             </div> 
              </div> -->
<div class="row row-sm">
    <div class="col-2">
        <div class="form-group">
            <label class="font-weight-300">Client Name</label>
            <select class="language form-control" name="client_id[]" id="client"
                @if(Request::is('timesheet/*/edit'))> <option disabled style="display:block">Select
                Client
                </option>

                @foreach($client as $clientData)
                <option value="{{$clientData->id}}"
                    {{$timesheet->client_id== $clientData->id??'' ?'selected="selected"' : ''}}>
                    {{$clientData->client_name }}</option>
                @endforeach


                @else
                <option></option>
                <option value="">Select Client</option>
                @foreach($client as $clientData)
                <option value="{{$clientData->id}}">
                    {{ $clientData->client_name }}</option>

                @endforeach
                @endif
            </select>   
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label class="font-weight-300">Project Name</label>
             <select class="form-control key" name="project_id[]" id="project">
             <option disabled style="display:block">Select
                Project
                </option>
                
            </select>
           
            <a href="{{url('project/create')}}">Add Project</a>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label class="font-weight-300" style="width:100px;">Job Name</label>
            <select class="form-control key" name="job_id[]" id="job">
               
            </select>
             <!-- <select class="form-control key" name="job_id[]" id="key" 
                @if(Request::is('timesheet/*/edit'))> <option disabled style="display:block">Select
                Job
               
                </option>
                @foreach($job as $jobData)
                <option value="{{$jobData->id}}"
                    {{$timesheet->client_id== $jobData->id??'' ?'selected="selected"' : ''}}>
                    {{$jobData->job_name }}</option>
                @endforeach


                @else
                <option></option>
                <option value="">Select Job</option>
                @foreach($job as $jobData)
                <option value="{{$jobData->id}}">
                    {{ $jobData->job_name }}</option>

                @endforeach
                @endif
            </select> -->
            <a href="{{url('job/create')}}">Add Job</a>
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <label class="font-weight-300" style="width:100px;">Work Item</label>
            <input type="text" name="workitem[]" id="key"
                value="{{ $timesheet->workitem ?? ''}}" class="form-control key">
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label class="font-weight-300">Billable Status</label>
            <select class="form-control key" name="billable_status[]" id="key" id="exampleFormControlSelect1">
                @if(Request::is('timesheet/*/edit')) >
                @if($timesheet->billable_status=='Billable')
                <option value="Billable">Billable</option>
                <option value="Non Billable">Non Billable</option>


                @else
                <option value="Non Billable">Non Billable</option>
                <option value="Billable">Billable</option>



                @endif
                @else
                <option value="Billable">Billable</option>
                <option value="Non Billable">Non Billable</option>

                @endif
            </select>
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <label class="font-weight-300">Description</label>
            <input type="text" name="description[]" id="key"
                value="{{ $timesheet->description ?? ''}}" class="form-control key">
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <label class="font-weight-300">Hour</label>
            <input type="time" class="form-control" id="key" name='hour[]' value="{{ $timesheet->hour ?? ''}}">
        </div>
    </div>
    <!-- <div class="col-3">
        <div class="form-group">
            <label class="font-weight-300">Date</label>
            <input type="date" class="form-control key" id="key"name='date[]' value="{{ $timesheet->date ?? ''}}">
        </div>
    </div> -->
    <div class="col-1">
            <div class="form-group" style="margin-top: 36px;">
                <a href="javascript:void(0);" class="add_button" title="Add field"><img
                        src="{{ url('backEnd/image/add-icon.png')}}" /></a>
            </div>
        </div>
</div>
</div>
<hr>
<div class="form-group">
    
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    <a class="btn btn-secondary" href="{{ url('timesheet') }}">
        Back</a>

</div>

