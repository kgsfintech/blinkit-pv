
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#myModal" href="">Add Asset Type</a></li>
		<!--	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
            <li class="breadcrumb-item active">+</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Asset Type
                List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
    
        <div class="card-body">
            @component('backEnd.components.alert')

            @endcomponent   
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            
                            <th>Assets Type</th>
                            <th>Question 1  </th>
                            <th>Question 2</th>
                            <th>Question 3</th>
                            <th>Question 4</th>
                            
                         <!--   <th>Edit</th>
                            <th>Contact</th>
                            <th>Deactivate</th>-->
                        </tr>
						
                    </thead>
                    <tbody>
                         @foreach($assets as $assetData)
                        <tr>

                            <td>{{$assetData->asset_type ??'' }}</td>
                                                        <td>{{$assetData->q1 }}</td>
                            <td>{{$assetData->q2 }}</td>
                            <td>{{$assetData->q3 }}</td>
							<td>{{$assetData->q4 }}</td>
						</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>

<script>
     $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
              type: "GET",
              dataType: "json",
              url: "{{ url('/changeStatus') }}",
              data: {'status': status, 'user_id': user_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
<!-- Modal -->
<div id="myModal" class="modal bd-example-modal-sm " role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
	  <form id="detailsForm" method="post" action="{{ url('clientassets/store')}}" enctype="multipart/form-data">
                @csrf
    <div class="modal-content">
      <div class="modal-header">
		  <h4 class="modal-title">Add Asset Type</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
		  <label>Asset Type</label>
		  <input class="form-control" name="client_id" value="{{$id ??''}}" type="hidden">
                <input class="form-control" name="asset_type" type="text">
            </div>
		 <div class="modal-body">
			   <label>Question 1</label>
                <input class="form-control" name="q1" type="text">
            </div>
		 <div class="modal-body">
			   <label>Question 2</label>
                <input class="form-control" name="q2" type="text">
            </div>
		<div class="modal-body">
			   <label>Question 3</label>
                <input class="form-control" name="q3" type="text">
            </div>
		<div class="modal-body">
			   <label>Question 4</label>
                <input class="form-control" name="q4" type="text">
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save </button>
      </div>
    </div>
	  </form>
  </div>
</div>
@endsection


