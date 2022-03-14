@extends('backEnd.layouts.layout') @section('backEnd_content')
<div class="main-content">
    <div class="body-content">
        <div class="row">
            <div class="col-sm-12 col-xl-8">
                <div class="media d-flex m-1 ">
                    <div class="align-left p-1">
                        <a href="#" class="profile-image">
                            <img src="{{$userInfo->profilepic ??''}}"
                                class="avatar avatar-xl rounded-circle img-border height-100" alt="Card image">
                        </a>
                    </div>
                    <div class="media-body text-left ml-3 mt-1">
                        <h3 class="font-large-1 white">{{$userInfo->team_member ??''}}
                            <span class="font-medium-1 white">({{ App\Models\Role::select('rolename')->where('id',$userInfo->role_id)->first()->rolename ?? ''}})</span>
                        </h3>
                        <p class="white">
                            <i class="fas fa-map-marker-alt"></i> {{$userInfo->address_proof ??''}} </p>
                        {{-- <p class="white text-bold-300 d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Nunc sed odio risus. Integer sit amet dolor elit. Suspendisse
                            ac neque in lacus venenatis convallis. Sed eu lacus odio</p> --}}
                   
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Title</h6>
                            </div>
                            <div class="col-auto">
                                <time class="fs-13 font-weight-600 text-muted">{{ App\Models\Title::select('title')->where('id',$userInfo->title_id)->first()->title ?? ''}}</time>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Birthday</h6>
                            </div>
                            <div class="col-auto">
                                <time class="fs-13 font-weight-600 text-muted" datetime="1988-10-24">{{$userInfo->dateofbirth ??''}}</time>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Date Of Joining</h6>
                            </div>
                            <div class="col-auto">
                                <time class="fs-13 font-weight-600 text-muted" datetime="2018-10-28">{{ date('d-M-y', strtotime($userInfo->joining_date)) }}</time>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Address</h6>
                            </div>
                            <div class="col-auto">
                                <span class="fs-13 font-weight-600 text-muted">{{$userInfo->address_proof ??''}}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Asset</h6>
                            </div>
                        </div>
                    </div>
                    @if($asset == null)
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col" style="text-align: center">
                                <h6 class="mb-0 font-weight-600">Not Assign</h6>
                            </div>
                           
                        </div>
                    </div>
                    @else
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Asset Type</h6>
                            </div>
                            <div class="col-auto">
                                <time class="fs-13 font-weight-600 text-muted" datetime="1988-10-24">@if($asset->item==0 ??'')
                                    <span >Laptop</span>
                                    @else
                                    <span>Mobile</span>
                                    @endif</time>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Assign Date</h6>
                            </div>
                            <div class="col-auto">
                                <time class="fs-13 font-weight-600 text-muted" datetime="1988-10-24">
                                    <td>{{ date('d-M-y', strtotime($asset->updated_at)) }}</td>
                     
                                </time>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 font-weight-600">Description</h6>
                            </div>
                            <div class="col-auto">
                                <time class="fs-13 font-weight-600 text-muted" datetime="1988-10-24">
                                    {!! $asset->description !!}
                                </time>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col" style="text-align: center">
                            <a href="{{url('/generateticket/'.$asset->id)}}"" class="btn btn-primary w-100p mb-2 mr-1">Create Ticket</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Ticket</h6>
                            </div>
                        </div>
                    </div>
                   
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="font-weight-600">Ticket</th>
                                        <th class="font-weight-600">Date</th>
                                        <th class="font-weight-600">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assetticket as $assetticketData)
                                    <tr>
                                        <td>{{$assetticketData->generateticket_id }}</td>
                                       <td>{{ date('d-M-y', strtotime($assetticketData->created_at)) }}</td>
                                        <td>@if($assetticketData->status==0)
                                            <span >open</span>
                                            @elseif($assetticketData->status==1)
                                            <span>working</span>
                                            @elseif($assetticketData->status==2)
                                            <span>close</span>
                                            @else
                                            <span>reject</span>
                                            @endif
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                       
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    @component('backEnd.components.alert')

                    @endcomponent   
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Edit Profile</h6>
                            </div>
																	    @if($teamprofile != null)
                            <div>
                                <a class="btn btn-success" href="{{ url('teamprofile/'.$teamprofile->id.'/edit') }}">
                                    edit resume</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <form method="post" action="{{ url('userprofile/update') }}" enctype="multipart/form-data">
                        @csrf  
                        <div>
                            <ul>
                                @foreach ($errors->all() as $e)
                                <li style="color:red;">{{$e}}</li>
                                @endforeach
                            </ul>
                        </div>
                    <div class="card-body">
                      
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="font-weight-600">Title</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="title_id"
                                        @if(Request::is('userprofile/*'))> <option disabled
                                        style="display:block">Please Select One</option>
                        
                                        @foreach($title as $titleData)
                                        <option value="{{$titleData->id}}"
                                            {{$userInfo->title_id== $titleData->id ??'' ?'selected="selected"' : ''}}>
                                            {{$titleData->title }}</option>
                                        @endforeach
                                       @endif
                                        </select>                        
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="font-weight-600">Name</label>
                                        <input type="text" name="id" hidden class="form-control" placeholder="Username"
                                        value="{{$userInfo->id}}">
                                        <input type="text" name="team_member" class="form-control" placeholder="Username"
                                            value="{{$userInfo->team_member ??''}}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="font-weight-600">Father Name</label>
                                        <input type="text" name="fathername" class="form-control" placeholder="Enter Father Name" value="{{$userInfo->fathername ??''}}">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Email address</label>
                                        <input type="email" name="emailid" class="form-control" value="{{$userInfo->emailid ??''}}" placeholder="Enter Email address">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Mobile Number</label>
                                        <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile Number" value="{{$userInfo->mobile_no ??''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Date Of Birth</label>
                                        <input type="text" name="dateofbirth" class="form-control" value="{{$userInfo->dateofbirth ??''}}" placeholder="Enter Date Of Birth">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Qualification</label>
                                        <input type="text" name="qualification" class="form-control" placeholder="Enter Qualification" value="{{$userInfo->qualification ??''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Address Proof</label>
                                        <input type="text" name="address_proof" class="form-control" placeholder="Enter Address Proof"
                                            value="{{$userInfo->address_proof ??''}}">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6  pl-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Address Upload</label>
                                        <input type="file" name="addressupload" class="form-control" placeholder="City" value="Mike">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Pan No</label>
                                        <input type="text" name="pancardno" class="form-control" placeholder="Enter Pan No" value="{{$userInfo->pancardno ??''}}">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label class="font-weight-600">Pan Upload</label>
                                        <input type="file" name="panupload" class="form-control" placeholder="ZIP Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-600">Permanent Address</label>
                                        <textarea rows="4" cols="80" name="permanentaddress" class="form-control"
                                            placeholder="Enter Permanent Address">{{$userInfo->permanentaddress ??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-600">Communication Address</label>
                                        <textarea rows="4" cols="80" name="communicationaddress" class="form-control"
                                            placeholder="Enter Communication Address">{{$userInfo->communicationaddress ??''}}</textarea>
                                    </div>
                                </div>
                            </div>
                      
                    </div>
                    <div class="card-footer">
                        <button type="submit" style="float:right;" class="btn btn-fill btn-primary">Save</button>
                    </div>
                    <br>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.body content-->
</div>
<!--/.main content-->
@endsection
