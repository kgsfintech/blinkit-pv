@extends('backEnd.layouts.layout') @section('backEnd_content')
  <!--Content Header (Page header)-->
  <div class="container">
    <h1 class="text-center my-4">PV Form</h1>



    <form action="{{ url('/clientassetregisterpvupdate/' . $id) }}" method="POST">
      @csrf
      <div class="row row-sm">
        <input type="hidden" name="asset_id" id="asset_id" value="{{ $asset->id ?? '' }}" readonly>
        <div class="col-4">
          <div class="form-group">
            <label class="font-weight-600" for="store_code">Store Code</label>
            <input type="text" id="store_code" name="store_code" class="form-control" placeholder="Enter Store Code"
              required value="{{ $asset->store_code ?? '' }}" readonly>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label class="font-weight-600" for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Enter Barcode" required
              value="{{ $asset->barcode ?? '' }}" readonly>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label class="font-weight-600" for="asset_name">Asset Name:</label>
            <input type="text" id="asset_name" name="asset_name" class="form-control" placeholder="Enter Asset Name"
              required value="{{ $asset->asset_name ?? '' }}" readonly>
          </div>
        </div>
      </div>

      <div class="row row-sm">
        <div class="col-4">
          <div class="form-group">
            <label class="font-weight-600" for="asset_type">Asset Type:</label>
            <input type="text" id="asset_type" name="asset_type" class="form-control" placeholder="Enter Asset Type"
              required value="{{ $asset->asset_type ?? '' }}" readonly>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label class="font-weight-600" for="uploaded_by">Uploaded By:</label>
            <input type="text" id="barcode" name="uploaded_by" class="form-control" placeholder="Enter Uploaded By"
              required value="{{ $asset->uploaded_by ?? '' }}" readonly>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label class="font-weight-600" for="qty">Quantity:</label>
            <input type="text" id="qty" name="qty" class="form-control" placeholder="Enter Quantity" required
              value="{{ $asset->qty ?? '' }}" readonly>
          </div>
        </div>
      </div>

      <div class="row row-sm">
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="q1">Q1:</label>
            <input type="text" id="q1" name="q1" class="form-control" required value="{{ $asset->q1 ?? '' }}"
              readonly>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="a1">A1:</label>
            <input type="text" id="a1" name="a1" class="form-control" required value="{{ $asset->a1 ?? '' }}">
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="q2">Q2:</label>
            <input type="text" id="q2" name="q2" class="form-control" required value="{{ $asset->q2 ?? '' }}"
              readonly>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="a2">A2:</label>
            <input type="text" id="a2" name="a2" class="form-control" required value="{{ $asset->a2 ?? '' }}">
          </div>
        </div>
      </div>

      <div class="row row-sm">
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="q3">Q3:</label>
            <input type="text" id="q3" name="q3" class="form-control" required value="{{ $asset->q3 ?? '' }}"
              readonly>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="a3">A3:</label>
            <input type="text" id="a3" name="a3" class="form-control" required value="{{ $asset->a3 ?? '' }}">
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="q4">Q4:</label>
            <input type="text" id="q4" name="q4" class="form-control" required value="{{ $asset->q4 ?? '' }}"
              readonly>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label class="font-weight-600" for="a4">A4:</label>
            <input type="text" id="a4" name="a4" class="form-control" required value="{{ $asset->a4 ?? '' }}">
          </div>
        </div>
      </div>
      <input type="submit" value="Physically Verified" class="btn btn-primary mt-3">
    </form>


    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
      $(function() {
        $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ url('/changeStatus') }}",
            data: {
              'status': status,
              'user_id': user_id
            },
            success: function(data) {
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
        <form id="detailsForm" method="post" action="{{ url('clientassetregister/store') }}"
          enctype="multipart/form-data">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Asset Register</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">

              <input class="form-control" name="client_id" value="{{ $id ?? '' }}" type="hidden">
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
