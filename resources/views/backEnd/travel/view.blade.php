@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
  
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
             @if($travel->teammember_id == Auth::user()->teammember_id)
    @if($travel->travelstatus=='0')
			<li class="breadcrumb-item"><a href="{{route('travel.edit', $travel->id ??'')}}">Edit
                    travel</a></li>
			   @endif
    @endif
  <li class="breadcrumb-item"><a href="{{url('travel')}}">Back</a></li>
        </ol>
    </nav>
 
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>travel
                    Details</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
        @component('backEnd.components.alert')

        @endcomponent
        <div class="card-body">

            <div class="card" style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);height:750px;">
                <div class="card-body">

                    <fieldset class="form-group">

                        <table class="table display table-bordered table-striped table-hover">

                            <tbody>

                                <tr>
                                    <td><b>Client Name : </b></td>
                                    <td>{{ $travel->client_name ??''}}</td>
                                    <td><b>Nature of Assignment : </b></td>
                                    <td>{{$travel->Nature_of_Assignment ??''}}</td>
                                </tr>
                                <tr>
                                    <td><b>Place of Visit : </b></td>
                                    <td>{{$travel->Place_of_visit ??''}}</td>
                                    <td><b>Purpose of visit : </b></td>
                                    <td>{!! $travel->Purpose_of_visit !!}</td>

                                </tr>

                                <tr>
                                    <td><b>Expected date of arrival : </b></td>
                                    <td>{{ date('F d,Y', strtotime($travel->Expected_date_of_arrival)) ??''}}</td>
                                    <td><b>Approver : </b></td>
                                    <td>{{ $travel->team_member ??'' ??''}} ( {{ $travel->rolename ??''}} )
                                    </td>

                                </tr>
                                <tr>
                                    <td><b> Travel Status</b></td>
                                    <td>@if($travel->travelstatus == 0)
                                        <span class="badge badge-pill badge-warning">Created</span>
                                        @elseif($travel->travelstatus == 1)
                                        <span class="badge badge-pill badge-success">Approved</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">Reject</span>
                                        @endif</td>
                                    <td><b>Attachment: </b></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td><b>Expected date of departure : </b></td>
                                    <td>{{ $travel->Expected_date_of_departure ??''}}</td>
                                    <td><b>Expected duration in days: </b></td>
                                    <td>{{ $travel->Expected_duration_in_days ??''}}</td>

                                </tr>
                                <tr>
                                    <td><b>Billable : </b></td>
                                    <td>@if($travel->Billable == 0)
                                        <span class="badge badge-pill badge-success">Yes</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">No</span>
                                        @endif</td>
                                    <td><b>Travel arrangements made by: </b></td>
                                    <td>@if($travel->Billable == 0)
                                        <span>Self</span>
                                        @elseif($travel->Billable == 1)
                                        <span>Company</span>
                                        @else
                                        <span>Client</span>
                                        @endif</td>

                                </tr>
                                <tr>
                                    <td><b>Train/Flight Ticket : </b></td>
                                    <td>{{ $travel->Train_Flight ??''}}</td>
                                    <td><b>Food: </b></td>
                                    <td>{{ $travel->Food ??''}}</td>

                                </tr>
                                <tr>
                                    <td><b>Conveyance : </b></td>
                                    <td>{{ $travel->Conveyance ??''}}</td>
                                    <td><b>Other: </b></td>
                                    <td>{{ $travel->Other ??''}}</td>

                                </tr>
                                <tr>
                                    <td><b>Total : </b></td>
                                    <td>{{ $travel->total ??''}}</td>
                                    <td><b>Status : </b></td>
                                    <td>@if($travel->Status == 2)
                                        <span>Pending</span>
                                        
                                    @elseif($travel->Status == 0)
                                        <span>Paid</span>
                                        @else
                                        <span>On Hold</span>
                                        @endif</td>

                                </tr>
                                @if($travel->Advance_Amount  != null)
                                <tr>
                                    <td><b>Advance Amount : </b></td>
                                    <td>{{ $travel->Advance_Amount ??''}}</td>
                                    @if($travel->comment  != null)
                                    <td><b>Comment (Reason for hold): </b></td>
                                    <td>{{ $travel->comment ??''}}</td>
                                    @endif

                                </tr>
                                @endif
                                @if(Request::is('travel/*'))
                                @if($travel->teammember_id == Auth::user()->teammember_id)

                                <tr>
                                    @if($travel->travelstatus=='0')
                                    <td><b>Action :</b></td>
                                    <td>
                                        <div class="row">

                                            <form method="post"
                                                action="{{ route('travel.update', $travel->id)}}"
                                                enctype="multipart/form-data">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit" class="btn btn-success"> Approve</button>
                                                <input type="text" hidden id="example-date-input" name="travelstatus"
                                                    value="1" class="form-control" placeholder="Enter Location">
                                            </form>
                                            <form method="post"
                                                action="{{ route('travel.update', $travel->id)}}"
                                                enctype="multipart/form-data">
                                                @method('PATCH')
                                                @csrf
                                                <button style="margin-left:11px;" type="submit" class="btn btn-danger">
                                                    Reject</button>
                                                <input hidden type="text" id="example-date-input" name="travelstatus"
                                                    value="2" class="form-control" placeholder="Enter Location">
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <td><b> </b></td>
                                    <td> @if($travel->travelstatus=='0')
                                        <button type="submit" class="btn btn-success" > Submit</button>
                                        @endif</td> --}}

                                </tr>


                                @endif
                                @endif
                            </tbody>

                        </table>


                    </fieldset>
                    @if(Request::is('travel/*'))
                    @if($travel->Status == 2 && Auth::user()->role_id == 17)
                
                    @if(Auth::user()->role_id == 17 || $travel->Advance_Amount  != null)
                        <div class="">
                            <form method="post" action="{{ route('travel.update', $travel->id)}}"  enctype="multipart/form-data">
                                @method('PATCH') 
                                @csrf            
                                @component('backEnd.components.alert')
        
                                @endcomponent   
                                <div class="row row-sm">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="font-weight-600">Advance Amount Given. *</label>
                                        <input type="number" name="Advance_Amount" value="{{ $travel->Advance_Amount ?? ''}}" class="form-control"
                                        placeholder="Enter Advance Amount">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="font-weight-600">Status. *</label>
                                        <select name="Status" id="exampleFormControlSelect1" class="form-control">
                                          <!--placeholder-->
                                          @if(Request::is('travel/*')) >
                                          @if($travel->Status=='0')
                                          <option value="0">Paid</option>
                                          <option value="1">On Hold</option>
                          
                                          @else
                                          <option value="1">On Hold</option>
                                          <option value="0">Paid</option>
                                        
                                         
                          
                                          @endif
                                          @else
                          
                                          <option value="">Please Select One</option>
                                          <option value="0">Paid</option>
                                          <option value="1">On Hold</option>
                                          @endif
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-12">
                                    <label class="font-weight-600">Comment (Reason for hold) </label>
                                    <textarea rows="3" name="comment" value="" class="form-control"
                                    placeholder="Enter Comment (Reason for hold)">{!! $travel->comment ??'' !!}</textarea>
                                </div>
                            </div>
                            <br>
                            @if(Auth::user()->role_id == 17 && $travel->Status == 2)
                            <button type="submit" class="btn btn-success" style="float:right"> Submit</button>
                            @endif
                        </form>
        
                    </div>
                    @endif
                    @endif
                    @endif
                </div>

            </div>


        </div>
    </div>

</div>
@endsection
