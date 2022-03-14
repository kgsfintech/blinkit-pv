<div class="row row-sm">
  <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Name of Candidate. *</label>
            <input type="text"  name="Name" value="{{ $employeereferral->Name ??''}}" class="form-control"
            placeholder="Enter Name of Candidate">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Contact Number of Candidate. *</label>
            <input type="number"  name="Contact" value="{{ $employeereferral->Contact ??''}}" class="form-control"
            placeholder="Enter Contact Number of Candidate">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Position Referred For. *</label>
            <input type="text"  name="Position_Referred" value="{{ $employeereferral->Position_Referred ??''}}" class="form-control"
                placeholder="Enter Position Referred.">
        </div>
        </div>
        
</div>
<div class="row row-sm">
  <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Current Organization.</label>
            <input type="text"  name="Current_Organization" value="{{ $employeereferral->Current_Organization ??''}}" class="form-control"
            placeholder="Enter Current Organization">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label class="font-weight-600">Relationship with Candidate. *</label>
            <input type="text"  name="Relationship" value="{{ $employeereferral->Relationship ??''}}" class="form-control"
            placeholder="Enter Relationship with Candidate">
        </div>
    </div>
    <div class="col-4">
    <div class="form-group">
            <label class="font-weight-600">Email Address of Candidate. *</label>
            <input type="email" id="reimbursementclaim-img" name="Email" value="{{ $employeereferral->Email ??''}}" class="form-control"
                placeholder="Enter Email">
        </div>
        </div>
         
</div>
<div class="row row-sm">
  <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Department Referred For (If any). *</label>
            <input type="text"  name="Department" value="{{ $employeereferral->Department ??''}}" class="form-control"
            placeholder="Enter Department Referred">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Current Designation. *</label>
            <input type="text"  name="Designation" value="{{ $employeereferral->Designation ??''}}" class="form-control"
            placeholder="Enter Current Designation">
        </div>
    </div>
    <div class="col-3">
    <div class="form-group">
            <label class="font-weight-600">Comment ( If Any). *</label>
            <input type="text"  name="Comment" value="{{ $employeereferral->Comment ??''}}" class="form-control"
            placeholder="Enter Comment">
        </div>
        </div>
           <div class="col-3">
        <div class="form-group">
            <label class="font-weight-600">Attach Resume.</label>
            <input type="file"  name="attachresume" class="form-control"
                placeholder="Enter Position Referred.">
        </div>
        </div>
</div>



<div class="form-group">
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    <a class="btn btn-secondary" href="{{ url('employeereferral') }}">
        Back</a>

</div>
