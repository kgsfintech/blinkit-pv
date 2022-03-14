<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Client Details</b></label>
        </div>
    </div>
</div>
<hr>
<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Name of Client</label>
            <select class="language form-control" id="exampleFormControlSelect1" name="client_id"
                @if(Request::is('outstationconveyance/*/edit'))> <option disabled style="display:block">Please Select
                One
                </option>

                @foreach($client as $clientData)
                <option value="{{$clientData->id}}"
                    {{$outstationconveyance->client_id== $clientData->id??'' ?'selected="selected"' : ''}}>
                    {{$clientData->client_name }}</option>
                @endforeach


                @else
                <option></option>
                <option value="">Please Select One</option>
                @foreach($client as $clientData)
                <option value="{{$clientData->id}}">
                    {{ $clientData->client_name }}</option>

                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Date & Assignment Appraisal Submited</label>
            <select class="form-control" name="Assignment">
                @if(Request::is('outstationconveyance/*/edit')) >
                @if($outstationconveyance->Assignment=='Yes')
                <option value="Yes">Yes</option>
                <option value="No">No</option>


                @else
                <option value="No">No</option>
                <option value="Yes">Yes</option>



                @endif
                @else

                <option value="">Please Select One</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>

                @endif

            </select>
        </div>
    </div>
   
</div>
<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Audit Period</b></label>
        </div>
    </div>
</div>
<hr>
<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Audit Period from Date</label>
            <input type="date" id="example-date-input" name="Audit_from_date"
                value="{{ $outstationconveyance->Audit_from_date ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Audit Period to Date</label>
            <input type="date" id="example-date-input" name="Audit_period_date"
                value="{{ $outstationconveyance->Audit_period_date ?? ''}}" class="form-control">
        </div>
    </div>
</div>
<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Vesting Period</b></label>
        </div>
    </div>
</div>
<hr>
<div class="row row-sm">
   
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Visiting Period from Date</label>
            <input type="date" id="example-date-input" name="Visiting_from_date"
                value="{{ $outstationconveyance->Visiting_from_date ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Visiting Period to Date</label>
            <input type="date" id="example-date-input" name="Visiting_date"
                value="{{ $outstationconveyance->Visiting_date ?? ''}}" class="form-control">
        </div>
    </div>

</div>
<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Tickets Details</b></label>
        </div>
    </div>
</div>
<hr>
<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Tickets Booked By</label>
            <select class="form-control" id="Tickets_Booked_By" name="Tickets_Booked_By">
                @if(Request::is('outstationconveyance/*/edit')) >
                @if($outstationconveyance->Tickets_Booked_By=='Office')
                <option value="Office">Office</option>
                <option value="Client">Client</option>
                <option value="Self">Self</option>

                @elseif($outstationconveyance->Tickets_Booked_By=='Client')
                <option value="Client">Client</option>
                <option value="Office">Office</option>
                <option value="Self">Self</option>

                @else
                <option value="Self">Self</option>
                <option value="Office">Office</option>
                <option value="Client">Client</option>


                @endif
                @else

                <option value="">Please Select One</option>
                <option value="Office">Office</option>
                <option value="Client">Client</option>
                <option value="Self">Self</option>
                @endif

            </select>
        </div>
    </div>
    <div class="col-4" id='designationn' >
        <div class="form-group">
            <label class="font-weight-600">Fare (Total Ticket Value in Rs.)</label>
            <input type="number" onchange="calc();" id="ticket" name="Fare" value="{{ $outstationconveyance->Fare ?? '0'}}"
                class="form-control" placeholder="Enter Fare">
        </div>
    </div>
    
</div>
<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Other Incidental Expenses</b></label>
        </div>
    </div>
</div>
<hr>
<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Conveyance Charges (Rs.)</label>
            <input type="number" onchange="calc();" id="conveyance" name="Conveyance_Charges"
                value="{{ $outstationconveyance->Conveyance_Charges ?? '0'}}" class="form-control"
                placeholder="Enter Conveyance Charges">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Coolie Charges (In Rs.)</label>
            <input type="number" onchange="calc();" id="coolie" name="Coolie_Charges"
                value="{{ $outstationconveyance->Coolie_Charges ?? '0'}}" class="form-control"
                placeholder="Enter Coolie Charges">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">During Journey (In Rs.)</label>
            <input type="number" onchange="calc();" id="journey" name="During_Journey"
                value="{{ $outstationconveyance->During_Journey ?? '0'}}" class="form-control"
                placeholder="Enter During Journey">
        </div>
    </div>
   

</div>
<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Miscellaneous Exp In Rs.(Please Specify)</label>
            <input type="number" onchange="calc();" id="miscellaneous" name="Miscellaneous_Exp"
                value="{{ $outstationconveyance->Miscellaneous_Exp ?? '0'}}" class="form-control"
                placeholder="Enter Miscellaneous Exp In Rs">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Food Expenses with Bill </label>
            <input type="number" onchange="calc();" id="food" name="Food_Expenses"
                value="{{ $outstationconveyance->Food_Expenses ?? '0'}}" class="form-control"
                placeholder="Enter Food Expenses with Bill">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Approved Rate of TA/Day</label>
            <input type="number" id="example-date-input" name="Approved_Rate"
                value="{{ $outstationconveyance->Approved_Rate ?? ''}}" class="form-control"
                placeholder="Enter Approved Rate of TA/Day">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">TA Claimed </label>
            <input type="number" onchange="calc();" id="claimed" name="TA_Claimed"
                value="{{ $outstationconveyance->TA_Claimed ?? '0'}}" class="form-control"
                placeholder="Enter TA Claimed">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Total Travelling BILL</label>
            <input type="number" id="total" name="Travelling_BILL"
                value="{{ $outstationconveyance->Travelling_BILL ?? '0'}}" class="form-control"
                placeholder="Enter Travelling BILL">
        </div>
    </div>
</div>
<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Advance Details</b></label>
        </div>
    </div>
</div>
<hr>
<div class="row row-sm">
  
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Advance from Office/Other (Name)</label>
            <input type="advanceoffice" id="example-date-input" name="Advance"
                value="{{ $outstationconveyance->Advance ?? ''}}" class="form-control"
                placeholder="Enter Advance in Rs.">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Advance in Rs.</label>
            <input type="number" id="example-date-input" name="Advance"
                value="{{ $outstationconveyance->Advance ?? ''}}" class="form-control"
                placeholder="Enter Advance in Rs.">
        </div>
    </div>
   
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Advance Received.</label>
            <input type="number" id="example-date-input" name="Advance_received"
                value="{{ $outstationconveyance->Advance_received ?? ''}}" class="form-control"
                placeholder="Enter Advance Received.">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Mark only one oval.</label>
             <select class="form-control" name="oval">
                @if(Request::is('outstationconveyance/*/edit')) >
                @if($outstationconveyance->oval=='Cash')
                <option value="Cash">Cash</option>
                <option value="Bank Account">Bank Account</option>


                @else
                <option value="Bank Account">Bank Account</option>
                <option value="Cash">Cash</option>



                @endif
                @else

                <option value="">Please Select One</option>
                <option value="Yes">Cash</option>
                <option value="No">Bank Account</option>

                @endif
            </select>
        </div>
    </div>
    
    
</div>
<div class="row row-sm ">
    <div class="col-12">
        <div class="form-group">
            <label class="fs-17 font-weight-600 mb-0"><b>Advance shared with Employees</b></label>
        </div>
    </div>
</div>
<hr>
@if(Request::is('outstationconveyance/create'))
<div class="field_wrapper">
    <div class="row row-sm">
        <div class="col-6">
            <div class="form-group">
                <label class="font-weight-600">Name</label>
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
                <label class="font-weight-600">Amount</label>
                <input type="number" id="key"  name="amount[]"
                value="{{ $outstationconveyance->amount ?? ''}}" class="form-control"
                placeholder="Enter Amount">
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
@endif
@if(Request::is('outstationconveyance/*/edit'))
<div class="table-responsive">
    <table class="table display table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="font-weight-600">Name</th>
                <th class="font-weight-600">Amount </th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($outstationconveyancesemployee as $outstationconveyancesemployeeData)
            <tr>
                <td>{{$outstationconveyancesemployeeData->team_member }}</td>
                <td>{{$outstationconveyancesemployeeData->amount }}</td>
              
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endif
<div class="row row-sm">
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Total Amount of BILL</label>
            <select class="form-control" name="bill">
                @if(Request::is('outstationconveyance/*/edit')) >
                @if($outstationconveyance->bill=='Bills Submitted(Only if Bills Uploaded)')
                <option value="Bills Submitted(Only if Bills Uploaded)">Bills Submitted(Only if Bills Uploaded)</option>
                <option value="Bills Not Submitted">Bills Not Submitted</option>
                <option value="No Supporting Bills">No Supporting Bills</option>

                @elseif($outstationconveyance->bill=='Bills Not Submitted')
                <option value="Bills Not Submitted">Bills Not Submitted</option>
                <option value="Bills Submitted(Only if Bills Uploaded)">Bills Submitted(Only if Bills Uploaded)</option>
                <option value="No Supporting Bills">No Supporting Bills</option>

                @else
                <option value="No Supporting Bills">No Supporting Bills</option>
                <option value="Bills Submitted(Only if Bills Uploaded)">Bills Submitted(Only if Bills Uploaded)</option>
                <option value="Bills Not Submitted">Bills Not Submitted</option>



                @endif
                @else

                <option value="">Please Select One</option>
                <option value="Bills Submitted(Only if Bills Uploaded)">Bills Submitted(Only if Bills Uploaded)</option>
                <option value="Bills Not Submitted">Bills Not Submitted</option>
                <option value="No Supporting Bills">No Supporting Bills</option>
                @endif

            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Copy of Supporting files</label>
            <input type="file" id="profile-img" name="attachment[]" multiple="multiple" value="{{ $outstationconveyance->attachment ?? ''}}"
                class="form-control" placeholder="Enter Copy of Supporting files">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Remarks</label>
            <input type="text" id="example-date-input" name="Remarks" value="{{ $outstationconveyance->Remarks ?? ''}}"
                class="form-control" placeholder="Enter Remarks">
        </div>
    </div>
    
</div>
<div class="form-group">
    @if(Request::is('outstationconveyance/*/edit'))  
    @if(23 == Auth::user()->teammember_id)
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Status</label>
            <select name="Status" id="exampleFormControlSelect1" class="form-control">
                <!--placeholder-->
                @if(Request::is('outstationconveyance/*/edit')) >
                @if($outstationconveyance->Status=='0')
                <option value="0">Created</option>
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
                <option value="3">Submitted</option>
                @elseif($outstationconveyance->Status=='1')
                <option value="1">Approved</option>
                <option value="0">Created</option>
               
                <option value="2">Rejected</option>
                <option value="3">Submitted</option>

                @elseif($outstationconveyance->Status=='2')
                <option value="2">Rejected</option>
                <option value="0">Created</option>
                <option value="1">Approved</option>               
                <option value="3">Submitted</option>

                @else
                <option value="3">Submitted</option>
                <option value="2">Rejected</option>
                <option value="1">Approved</option>
                <option value="0">Created</option>
                

                @endif
                @else

                <option value="0">Created</option>
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
                <option value="3">Submited</option>
                @endif
            </select>
        </div>
    </div>
    @endif
    @endif
</div>
<div class="form-group">
    @if(Request::is('outstationconveyance/create'))
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    @endif
    @if(Request::is('outstationconveyance/*/edit'))
    @if($outstationconveyance->Status=='0' || $outstationconveyance->Status=='4')
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    @endif
    @if(Auth::user()->role_id == 17)
    @if($outstationconveyance->Status != '3')
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    @endif
    @endif
    @endif
    <a class="btn btn-secondary" href="{{ url('outstationconveyance') }}">
        Back</a>

</div>
<script>
       function calc() {
           debugger;
        var value1 =0;
        var value2 =0;
        var value3 =0;
        var value4 =0;
        var value5 =0;
        var value6 =0;
        var value7 =0;
        value1= document.getElementById('ticket').value;

         value2 = document.getElementById('conveyance').value;
      value3 = document.getElementById('coolie').value;
         value4 = document.getElementById('journey').value;
         value5 = document.getElementById('miscellaneous').value;
         value6 = document.getElementById('food').value;
         value7 = document.getElementById('claimed').value;
    //    debugger;
        var value8 = parseInt(value1);
        var value9 = parseInt(value2);
        var value10 = parseInt(value3);
        var value11 = parseInt(value4);
        var value12 = parseInt(value5);
        var value13 = parseInt(value6);
        var value14 = parseInt(value7);
        debugger;

        var result = value8 + value9 + value10 + value11 + value12 + value13 + value14;
    //      debugger;
        //    alert(result);
        document.getElementById('total').value = result;
    }

</script>