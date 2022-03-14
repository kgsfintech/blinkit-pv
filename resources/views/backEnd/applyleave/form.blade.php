<div class="row row-sm">
  <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Leave</label>
            <select  class="language form-control" id="exampleFormControlSelect1" name="leavetype"
            @if(Request::is('applyleave/*/edit'))> <option disabled style="display:block">Please Select One</option>

            @foreach($leavetype as $leavetypeData)
            <option value="{{$leavetypeData->id}}"
                {{$applyleave->leavetype == $leavetypeData->id??'' ?'selected="selected"' : ''}}>
                {{$leavetypeData->name }}</option>
            @endforeach


            @else
            <option></option>
            <option value="">Please Select One</option>
            @foreach($leavetype as $leavetypeData)
            <option value="{{$leavetypeData->id}}">
                {{ $leavetypeData->name }}</option>

            @endforeach
            @endif
        </select>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">From *</label>
            <input type="date"  name="from" value="{{ $applyleave->from ??''}}" required class="form-control"
            placeholder="">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">To *</label>
            <input type="date"  name="to" value="{{ $applyleave->to ??''}}" required class="form-control"
                placeholder="">
        </div>
        </div>
         
</div>
<br>
<div class="row row-sm">
  <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Team Email ID (If Any)</label>
            <select class="form-control basic-multiple"  multiple="multiple" id="category" name="teammember_id[]" @if(Request::is('applyleave/*/edit'))>
               

                @foreach($teammember as $teammemberData)
                <option value="{{$teammemberData->id}}" @if(($task->teammember_id) == $teammemberData->id) selected
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
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Reason for leave *</label>
            <input type="text"  name="reasonleave" value="{{ $applyleave->reasonleave ??''}}" class="form-control"
            placeholder="Enter Reason for leave">
        </div>
    </div>
    <div class="col-4">
    <div class="form-group">
            <label class="font-weight-600">Choose Approver *</label>
            <select  class="language form-control" id="exampleFormControlSelect1" name="approver"
            @if(Request::is('applyleave/*/edit'))> <option disabled style="display:block">Please Select One</option>

            @foreach($teammember as $teammemberData)
            <option value="{{$teammemberData->id}}"
                {{$applyleave->Approver == $teammemberData->id??'' ?'selected="selected"' : ''}}>
                {{$teammemberData->team_member }}( {{$teammemberData->role->rolename }} )</option>
            @endforeach


            @else
            <option></option>
            <option value="">Please Select One</option>
            @foreach($teammember as $teammemberData)
            <option value="{{$teammemberData->id}}">
                {{ $teammemberData->team_member }}  ( {{$teammemberData->role->rolename }} )</option>

            @endforeach
            @endif
        </select>     
        </div>
        </div>
        @if(Request::is('applyleave/*/edit'))  
    @if(23 == Auth::user()->teammember_id)
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">status</label>
            <select name="status" id="exampleFormControlSelect1" class="form-control">
                <!--placeholder-->
                @if(Request::is('applyleave/*/edit')) >
                @if($applyleaveDatas->status=='0')
                <option value="0">Pending</option>
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
                @elseif($applyleaveDatas->status=='1')
                <option value="1">Approved</option>
                <option value="0">Pending</option>
                <option value="2">Rejected</option>

                @elseif($applyleaveDatas->status=='2')
                <option value="2">Rejected</option>
                <option value="0">Pending</option>
                <option value="1">Approved</option>               
                @endif
                @else

                <option value="0">Pending</option>
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
                @endif
            </select>
        </div>
    </div>
    @endif
    @endif
         
</div>
<br>
<div class="form-group">
    <button type="submit" class="btn btn-success" style="float:right"> Apply</button>
    <a class="btn btn-secondary" href="{{ url('applyleave') }}">
        Cancel</a>

</div>
<script>
  
$(document).ready(function() {
    $('.dropdown').select2();
});
    </script>
