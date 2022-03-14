 <!--Third party Styles(used by this page)--> 
 <link href="{{ url('backEnd/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">
 <link href="{{ url('backEnd/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css')}}" rel="stylesheet">
 <link href="{{ url('backEnd/plugins/jquery.sumoselect/sumoselect.min.css')}}" rel="stylesheet">

@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            @if(23 == Auth::user()->teammember_id || Auth::user()->teammember_id == $outstationconveyance->createdby)
            @if($outstationconveyance->Status=='0' || $outstationconveyance->Status=='4')
            <li class="btn btn-info ml-2"><a href="{{route('outstationconveyance.edit', $outstationconveyance->id ??'')}}" style="color:white;">Edit
                    </a></li>
			   @endif
			   @endif
			<li>     <a class="btn btn-success ml-2" href="{{ url('outstationconveyance') }}">
          Back</a></li>

        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Outstation Conveyance
                    List</small>
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
            <div class="card" style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);height:850px;">
              
                <div class="card-body">
                   
                    <div class="card-head" style="width:930px;height: 10px;">
						<!-- <a style="margin-top: -17px;"
                data-toggle="modal" data-target="#exampleModal12"
                    class="btn btn-info-soft btn-sm">Mail <i class="far fa-envelope"></i></a> -->
                     
                    </div>
                    <fieldset class="form-group">

                        <table class="table display table-bordered table-striped table-hover">

                            <tbody>
                           
                                <tr>
                                    <td><b>Name of Client : </b></td>
                                    <td>{{ $outstationconveyance->client_name ??''}}</td>
                                    <td><b>Date & Assignment Appraisal Submited :</b></td>
                                    <td>{{$outstationconveyance->Assignment }}</td>
                                </tr>
                                <tr>
                                <td><b>Audit Period from Date : </b></td>
                                    <td>{{ date('F d,Y', strtotime($outstationconveyance->Audit_from_date)) }}</td>
                                    <td><b>Audit Period to Date : </b></td>
                                    <td>{{ date('F d,Y', strtotime($outstationconveyance->Audit_period_date)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Visiting from Date : </b></td>
                                     <td>{{ date('F d,Y', strtotime($outstationconveyance->Visiting_from_date)) }}</td>
                                     <td><b>Visiting from Date :</b></td>
                                     <td>{{ date('F d,Y', strtotime($outstationconveyance->Visiting_date)) }}</td>
                              </tr>
                                <tr>
                                <td><b>Tickets Booked By : </b></td>
                                    <td>{{ $outstationconveyance->Tickets_Booked_By}}</td>
                                    <td><b>Fare :</b></td>
                                    <td>{{$outstationconveyance->Fare }}</td>
                                </tr>
                                <tr>
                                  
                                    <td><b>Conveyance Charges : </b></td>
                                    <td>{{ $outstationconveyance->Conveyance_Charges }}</td>
                                    <td><b>Coolie Charges :</b></td>
                                    <td>{{$outstationconveyance->Coolie_Charges }}</td>
                                   
                                </tr>
                              
                             <tr>  
                                    <td><b>During Journey : </b></td>
                                    <td>{{ $outstationconveyance->During_Journey}}</td>
                                    <td><b>Miscellaneous Exp :</b></td>
                                    <td>{{$outstationconveyance->Miscellaneous_Exp }}</td>
                                </tr>
                                <tr>
                                    <td><b>Food Expenses : </b></td>
                                    <td>{{ $outstationconveyance->Food_Expenses}}</td>
                                    <td><b>Approved Rate :</b></td>
                                    <td>{{$outstationconveyance->Approved_Rate }}</td>
                                   
                                </tr>
                                <tr>
                                   <td><b>TA_Claimed : </b></td>
                                    <td>{{ $outstationconveyance->TA_Claimed}}</td>
                                    <td><b>Travelling BILL :</b></td>
                                    <td>{{$outstationconveyance->Travelling_BILL }}</td>
                                 </tr>
                                 <tr>
                                        @if($outstationconveyance->correction != null)
                                        <td>
                                        <b>Correction/Clarification : </b></td>
                                        <td>{{ $outstationconveyance->correction}}</td>
                                        @endif
                                   </tr>
                                 <tr>  
                                    <td><b>Attachment : </b></td>
                                    <td><a style="color: #37A000" data-toggle="modal" data-target="#exampleModal1" 
                                        >View</a></td>
                                    <td><b>Createdby : </b></td>
                                     <td>{{ App\Models\Teammember::select('team_member')->where('id',$outstationconveyance->createdby)->first()->team_member ?? ''}}</td>
                                    
                                </tr>
                                <tr>
                                    <td><b>Advance : </b></td>
                                    <td>{{ $outstationconveyance->Advance}}</td>
                                    <td><b>Advance Received :</b></td>
                                    <td>{{$outstationconveyance->Advance_received }}</td>
                                </tr>
                                <tr>
                                  <td><b>Mark only one oval : </b></td>
                                    <td>{{ $outstationconveyance->oval}}</td>
                                    <td><b>Remarks : </b></td>
                                    <td>{{ $outstationconveyance->Remarks}}</td>
                            </tr>
                             <tr> 
                                    <td><b>Bill :</b></td>
                                    <td>{{$outstationconveyance->bill }}</td>
                                    <td><b>Status : </b></td>
                                    <td>@if($outstationconveyance->Status==0)
                                <span class="badge badge-info">Created</span>
                                @elseif($outstationconveyance->Status==1)
                                <span class="badge badge-success">Approved</span>
                                @elseif($outstationconveyance->Status==2)
                                <span class="badge badge-danger">Rejected</span>
                                @elseif($outstationconveyance->Status==4)
                                <span class="badge badge-secondary">Pending For Correction/Clarification</span>
                               
                                @else
                                <span class="badge badge-warning">Submitted</span>
                                @endif</td>
                                </tr>
                              
                
                            </tbody>
                           
                        </table>
                          
                       
                        
                    </fieldset>
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover">
                           <thead>
                               <tr>
                                  
                                   <th>Name</th>
                                   <th>Amount</th>
                                   
                               </tr>
                           </thead>
                           <tbody>
                           @foreach($outstationconveyanceData as $outstationconveyances)
                           <tr>
                              <td>{{$outstationconveyances->team_member }}</td>
                              <td>{{$outstationconveyances->amount }}</td>
                              
                               </tr>
                            @endforeach
                           </tbody>
                       </table>
                   </div>
                   <fieldset class="form-group">

                    <table class="table display table-bordered table-striped table-hover">

                        <tbody>
                       
                            <tr>
                                @if(Request::is('outstationconveyance/*'))  
                                @if(23 == Auth::user()->teammember_id)
                                
                                    @if($outstationconveyance->Status=='0' || $outstationconveyance->Status=='4')
                                    <td><b>Action :</b></td>
                                    <td>  
                                        <div class="row">
                                  
                                    <form method="post" action="{{ route('outstationconveyance.update', $outstationconveyance->id)}}"  enctype="multipart/form-data">
                                        @method('PATCH') 
                                        @csrf   
                                    <button type="submit" class="btn btn-success" > Approve</button>
                                    <input type="text" hidden id="example-date-input" name="Status" value="1" class="form-control"
                                    placeholder="Enter Location">
                                    </form>
                                    <form method="post" action="{{ route('outstationconveyance.update', $outstationconveyance->id)}}"  enctype="multipart/form-data">
                                        @method('PATCH') 
                                        @csrf 
                                    <button style="margin-left:11px;" type="submit" class="btn btn-danger" > Reject</button>
                                    <input hidden type="text" id="example-date-input" name="Status" value="2" class="form-control"
                                    placeholder="Enter Location">
                                </form>
                                <button style="margin-left:11px;height: 35px;"  data-toggle="modal"    data-target="#exampleModal12" class="btn btn-info" >Clarification</button>
                                    @endif
                                    </div>
                                    </td>

                              
                           
                            @endif
                            @endif
                            </tr>
                        </tbody>
                    </table>
                   </fieldset>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    function myFunction() {
      document.getElementById("panel").style.display = "block";
    }
	</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ url('backEnd/ckeditor/ckeditor.js')}}"></script>
    
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    
    </script>
    
@endsection

<!--Page Active Scripts(used by this page)-->
<script src="{{ url('backEnd/dist/js/pages/forms-basic.active.js')}}"></script>
<!--Page Scripts(used by all page)-->
<script src="{{ url('backEnd/dist/js/sidebar.js')}}"></script>

 <!-- Small modal -->
 <div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
           <div class="modal-header" style="background:#37A000">
               <h5 style="color: white" class="modal-title font-weight-600" id="exampleModalLabel1">Ask for Correction/Clarification</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form method="post" action="{{ route('outstationconveyance.update', $outstationconveyance->id)}}"  enctype="multipart/form-data">
               @method('PATCH') 
               @csrf   
           <div class="modal-body">
               <div class="row row-sm">
                   <div class="col-12">
                       <div class="form-group">
                           <textarea rows="6" name="correction" class="form-control"
                               placeholder=""></textarea>
                               <input hidden type="text" id="example-date-input" name="Status" value="4" class="form-control"
                               placeholder="Enter Location">
                       </div>
                   </div>
                   </div>
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               <button type="submit" style="float: right" class="btn btn-success">Save </button>
           </div>
           </form>
       </div>
   </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="detailsForm" method="post" action="{{ url('viewassignment/contactupdate') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background:#37A000 ">
                    <h5 style="color: white" class="modal-title font-weight-600" id="exampleModalLabel4">Outstation Conveyance Files</h5>
                    <div>
                        <ul>
                            @foreach ($errors->all() as $e)
                            <li style="color:red;">{{$e}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <div class="modal-body">
                    <div class="table-responsive">

                        <table class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>File</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($outstationconveyancefile as $outstationconveyancefiles)
                                <tr>
                                    <td><a target="blank" href="{{url('/backEnd/image/outstationconveyance/'.$outstationconveyancefiles->attachment)}}">{{ $outstationconveyancefiles->attachment??''}}</a></td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>