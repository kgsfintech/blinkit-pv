<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Client *</label>
            <select class="language form-control" id="category" name="client_id"
                @if(Request::is('assignmentmapping/*/edit'))> <option disabled style="display:block">Please Select One
                </option>

                @foreach($client as $clientData)
                <option value="{{$clientData->id}}"
                    {{$assignmentmapping->client->id== $clientData->id??'' ?'selected="selected"' : ''}}>
                    {{$clientData->client_name }} (  {{$clientData->gstno ??''}} )</option>
                @endforeach


                @else
                <option></option>
                <option value="">Please Select One</option>
                @foreach($client as $clientData)
                <option value="{{$clientData->id}}">
                    {{ $clientData->client_name }} (  {{$clientData->gstno ??''}} )</option>

                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Assignment *</label>
            <select class="form-control" id="subcategory_id" name="assignment_id"
               > 
            </select>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label class="font-weight-600">Period End</label>
            <input type="date" name="periodend" value="{{ $assignmentmapping->periodend ?? ''}}" class=" form-control"
                placeholder="Enter Perio End">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Is Role Over Assignment</label>
            <select class="form-control" id="exampleFormControlSelect1" name="roleassignment">
                <option value="1">No</option>
                <option value="2">Yes</option>

            </select>
        </div>
    </div>
</div>
<div class="row row-sm">
   
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Est Hours</label>
            <input type="text" name="esthours" value="{{ $assignmentmapping->esthours ?? ''}}" class=" form-control"
                placeholder="Enter Est Hours">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Std Cost</label>
            <input type="text" name="stdcost" value="{{ $assignmentmapping->stdcost ?? ''}}" class=" form-control"
                placeholder="Enter Std Cost">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Est Cost</label>
            <input type="text" name="estcost" value="{{ $assignmentmapping->estcost ?? ''}}" class=" form-control"
                placeholder="Enter Est Cost">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Lead Partner *</label>
            <select class="language form-control" id="category" name="leadpartner"
            @if(Request::is('client/*/edit'))> <option disabled
            style="display:block">Please Select One</option>

            @foreach($partner as $teammemberData)
            <option value="{{$teammemberData->id}}"
            @if(($client->leadpartner) == $teammemberData->id) selected @endif>
                {{ $teammemberData->title->title ??''}}. {{ $teammemberData->team_member }}</option>
            @endforeach


            @else
            <option></option>
            <option value="">Please Select One</option>
            @foreach($partner as $teammemberData)
            <option value="{{$teammemberData->id}}">
                {{ $teammemberData->title->title ??''}}. {{ $teammemberData->team_member }}</option>

            @endforeach
            @endif
        </select>
        </div>
    </div>
</div>
<div class="field_wrapper">
    <div class="row row-sm">
        <div class="col-6">
            <div class="form-group">
                <label class="font-weight-600">Name *</label>
                <select class="language form-control" id="key" name="teammember_id[]">

                    <option>Please Select One</option>
                    @foreach($teammember as $teammemberData)
                    <option value="{{$teammemberData->id}}" @if(!empty($store->
                        financial) && $store->
                        financial==$teammemberData->id) selected @endif>
                          {{ $teammemberData->title->title ??''}}. {{ $teammemberData->team_member }}  ( {{ $teammemberData->role->rolename }} )</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <label class="font-weight-600">Type *</label>
                <select class="form-control key" id="key" name="type[]" >

                    <option>Please Select One</option>
                    <option value="0">Team Leader</option>
                    <option value="2">Staff</option>
                </select>
            </div>
        </div>
      
        <div class="col-1">
            <div class="form-group" style="margin-top: 36px;">
                <a href="javascript:void(0);" class="add_buttonn" title="Add field"><img
                        src="{{ url('backEnd/image/add-icon.png')}}" /></a>
            </div>
        </div>
       
   
</div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    <a class="btn btn-secondary" href="{{ url('assignmentmapping') }}">
        Back</a>

</div>
