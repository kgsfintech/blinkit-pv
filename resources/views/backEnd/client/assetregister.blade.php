
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#myModal" href="">Add Asset Register</a></li>
		<!--	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
            <li class="breadcrumb-item active">+</li></br>
            <li class="breadcrumb-item"><a href="{{url('/clientassetregistermerge/'.$id)}}">Merge Questions</a></li>
        </ol>
       
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Asset Register
                List</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
    <form method="post" action="{{ url('clientassetregister/storecode')}}" enctype="multipart/form-data">
                @csrf
                <label>Store code</label>
                <input class="form-control" name="store_code" type="text">
                <button type="submit" class="btn btn-success">Autogenerate Barcode </button>
	  </form>
      
        <div class="card-body">
            @component('backEnd.components.alert')

            @endcomponent   
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            
                            <th>Store Code </th>
                            <th>Barcode  </th>
                            <th>Asset Name</th>
                            <th>Asset Type</th>
                            <th>Uploaded By</th>
							 <th>Verified By</th>
							 <th>Verified At</th>
							<th>Photo</th>
                            <th>Quantity</th>
                            <th>Question 1 </th>
                            <th>Answer 1</th>
                            <th>Question 2 </th>
                            <th>Answer 2</th>
                            <th>Question 3 </th>
                            <th>Answer 3</th>
                            <th>Question 4 </th>
                            <th>Answer 4</th>
                            
                         <!--   <th>Edit</th>
                            <th>Contact</th>
                            <th>Deactivate</th>-->
                        </tr>
						
                    </thead>
                    <tbody>
                         @foreach($assets as $assetData)
                        <tr>

                            <td>{{$assetData->store_code ??'' }}</td>
                            <td>{{$assetData->barcode }}</td>
                            <td>{{$assetData->asset_name}}</td>
                            <td>{{$assetData->asset_type }}</td>
                            <td>{{$assetData->uploaded_by}}</td>
							 <td>{{$assetData->verified_by}}</td>
							 <td>{{$assetData->verified_at}}</td>
							<td><a href="{{url('backEnd/image/asset_register/'.$assetData->photo)}}">{{$assetData->photo ??''}}</a></td>
							<td>{{$assetData->qty }}</td>
                            <td>{{$assetData->q1 }}</td>
                            <td>{{$assetData->a1 }}</td>
                            <td>{{$assetData->q2 }}</td>
                            <td>{{$assetData->a2 }}</td>
                            <td>{{$assetData->q3 }}</td>
                            <td>{{$assetData->a3 }}</td>
                            <td>{{$assetData->q4 }}</td>
                            <td>{{$assetData->a4 }}</td>

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
	  <form id="detailsForm" method="post" action="{{ url('clientassetregister/store')}}" enctype="multipart/form-data">
                @csrf
    <div class="modal-content">
      <div class="modal-header">
		  <h4 class="modal-title">Add Asset Register</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
		  
		  <input class="form-control" name="client_id" value="{{$id ??''}}" type="hidden">
           </div>
           <div class="modal-body">
			   <label>Store code</label>
                <input class="form-control" name="store_code" type="text">
            </div>
		 <div class="modal-body">
			   <label>Barcode</label>
                <input class="form-control" name="barcode" type="text">
            </div>
		 <div class="modal-body">
			   <label>Asset Name</label>
                <input class="form-control" name="asset_name" type="text">
            </div>
		<div class="modal-body">
			   <label>Asset Type</label>
                <input class="form-control" name="asset_type" type="text">
            </div>
            <div class="modal-body">
			   <label>Quantity</label>
                <input class="form-control" name="qty" type="text">
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


