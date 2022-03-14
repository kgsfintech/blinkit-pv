<div class="row row-sm">
    <div class="col-6">
        <div class="form-group">
            <label class="font-weight-600">Title</label>
            <input type="text" name="title" value="{{ $notification->title ?? ''}}" class="form-control"
            placeholder="Enter Title">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="font-weight-600">Target.</label>
            <select class="form-control" id="exampleFormControlSelect1" name="targettype">
                <option >Please Select One</option>
                <option value="1">Individual</option>
                <option value="2">All Member</option>
                <option value="3">Partner</option>
            </select>
        </div>
    </div>
</div>
    <div class="row row-sm">
    <div class="col-12"  style='display:none;' id='designation'>
        <div class="form-group">
            <br>
        <div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th> Name</th>
                        <th>Designation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teammember as $teammemberData)
                    <tr>
                        <td><input name="teammember_id[]" style="width: 5%;" type="checkbox" class="selectbox"
                            value="{{$teammemberData->id}}"></td>
                        <td>{{$teammemberData->team_member}}</td>
                        <td>{{$teammemberData->role->rolename}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>

<div class="form-group">
    <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
    <a class="btn btn-secondary" href="{{ url('notification') }}">
        Back</a>

</div>
