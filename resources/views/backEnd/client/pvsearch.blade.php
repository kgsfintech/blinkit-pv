
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="container">
    <h1 class="text-center my-4">search Asset</h1>
    <div class="row">
      <div class="col-md-8 m-auto mb-4">
        <form action="{{url("/clientassetregisterpvsearch/" .$id)}}" method="post" class="d-flex">
          @csrf
          <input type="text" name="search" id="search" class="form-control" placeholder="enter barcode...">
          <input type="submit" value="Search" class="btn btn-outline-primary">
        </form>
      </div>
    </div>
  

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
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save </button>
      </div>
    </div>
	  </form>
  </div>
</div>
@endsection


