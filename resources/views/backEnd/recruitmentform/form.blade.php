<div class="row row-sm">
  <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Category</label> 
          
                <select class="form-control" name="categoryname" onchange='CheckColors(this.value);' >
                                 <option value="" >Please select one</option>
                                    <option value="Chartered Accountant">Chartered Accountant</option>
                                    <option value="Semi Qualified Chartered Accountant">Semi Qualified Chartered Accountant</option>
                                    <option value="Articled Trainee">Articled Trainee</option>
                                
                                    <option value="others">Other</option>
                                </select> 
                           </div> 
        </div>
        <div class="col-3">
        <div class="form-group" style="margin-top:30px;">
        <input type="text" class="form-control" name="other" id="qualification" plaaceholder="Highest Qualification" style='display:none; '/>
        </div>
    </div>  
    <div class="col-3">
        <div class="form-group">
        <label class="font-weight-600">Required Experience</label>
        <input type="nember" name="required_experience" class="form-control" value="{{ $recruitmentform->startdate ??''}}" />          
        </div>
    </div>  
    <div class="col-3">
        <div class="form-group">
        <label class="font-weight-600">Required for Client </label>
        <select class="language form-control" name="client_id[]"  multiple="" id="mutibusiness"
                @if(Request::is('recruitmentform/*/edit'))> <option disabled style="display:block">Select
                Client
                </option>

                @foreach($client as $clientData)
                <option value="{{$clientData->id}}"
                    {{$project->client_id== $clientData->id??'' ?'selected="selected"' : ''}}>
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
</div>
<div class="row row-sm">
<div class="col-4">
    <div class="form-group">
    <label class="font-weight-600">Required for Assignment/Project </label>
    <input type="text" name="assignment_project" class="form-control" value="{{ $recruitmentform->enddate ??''}}" /> 
        
        </div>
    </div> 
    <div class="col-4">
    <div class="form-group">
    <label class="font-weight-600">Number of Vacancies </label>
    <input type="number" name="number_of_vacancies" class="form-control" value="{{ $recruitmentform->enddate ??''}}" /> 
        </div>
    </div>  
    <div class="col-4">
    <div class="form-group">
    <label class="font-weight-600">Timeline </label>
    <input type="date" name="timeline" class="form-control" value="{{ $recruitmentform->enddate ??''}}" /> 
        
        </div>
    </div>  
</div>
<div class="row row-sm">
<div class="col-6">
    <div class="form-group">
    <label class="font-weight-600">Priority</label>
    <select class="form-control" name="priority">
                
                @if(Request::is('recruitmentform/*/edit')) >
                @if($recruitmentform->priority=='High')
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
         @elseif($recruitmentform->priority=='Medium')
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
                <option value="High">High</option>
            
        @else
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
          @endif                               
         @else
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
        @endif          
            </select>
        </div>
    </div> 
    <div class="col-6">
    <div class="form-group">
    <label class="font-weight-600">Name of Approving Authority </label>
    <select class="form-control basic-multiple" id="category" name="teammember_id" @if(Request::is('applyleave/*/edit'))>
               

               @foreach($teammember as $teammemberData)
               <option value="{{$teammemberData->id}}" @if(($applyleave->teammember_id) == $teammemberData->id) selected
                   @endif>
                   {{ $teammemberData->title->title }}. {{ $teammemberData->team_member }}(
                   {{ $teammemberData->role->rolename}} )</option>
               @endforeach


               @else
               <option></option>
              
               @foreach($teammember as $teammemberData)
               <option value="{{$teammemberData->id}}">
                   {{ $teammemberData->team_member }} ( {{ $teammemberData->role->rolename}} )</option>

               @endforeach
               @endif
           </select>
        </div>
    </div>
     
</div>
<div class="row row-sm">
<div class="col-6">
    <div class="form-group">
    <label class="font-weight-600">Detailed Job Profile </label>
    <textarea type="text"  name="detailed_Job_profile" class="form-control"
                placeholder="">{{ $holiday->description ??''}}</textarea>
        </div>
    </div>  
    <div class="col-6">
    <div class="form-group">
    <label class="font-weight-600">Any Specific Skills</label>
    <textarea type="text"  name="specific_skills" class="form-control"
                placeholder="">{{ $holiday->description ??''}}</textarea>
        </div>
    </div>
     
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    <a class="btn btn-secondary" href="{{ url('recruitmentform') }}">
        Cancel</a>

</div>

