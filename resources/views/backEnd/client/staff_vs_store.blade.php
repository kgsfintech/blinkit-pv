@extends('backEnd.layouts.layout') @section('backEnd_content')

  <!--Content Header (Page header)-->
  <div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
      <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('staff_vs_store/' . $client_id) }}">Staff Vs. Store</a></li>
        <li class="breadcrumb-item active">+</li>
      </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
      <div class="media">
        <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
        <div class="media-body">
          <h1 class="font-weight-bold">Home</h1>
          <small>Staff vs Store</small>
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
        <h1>Staff vs. Store</h1>
        <div class="row">
          <div class="col-md-6">
            <form action="{{ url('staff_vs_store_add/' . $client_id) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="">Staff:</label>
                <select name="staff_id" id="staff_id" class="form-control">
                  @if ($staffs)
                    @foreach ($staffs as $staff)
                      <option value="{{ $staff->id }}">{{ $staff->team_member }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="">Client:</label>
                <select name="client_id" id="client_id" class="form-control">
                  @if ($clients)
                    @foreach ($clients as $client)
                      <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="">Store:</label>
                <select name="store_code" id="store_code" class="form-control">
                  @if ($stores)
                    @foreach ($stores as $store)
                      <option value="{{ $store->store_code }}">{{ $store->name }} - {{$store->store_code}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <input type="submit" value="Add" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!--/.body content-->

  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


@endsection
