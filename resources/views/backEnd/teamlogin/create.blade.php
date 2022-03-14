@extends('backEnd.layouts.layout') @section('backEnd_content')
<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
   
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Create Login Member</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('teamlogin.store')}}" enctype="multipart/form-data">
                        @csrf
                  @component('backEnd.components.alert')

                  @endcomponent
                        @include('backEnd.teamlogin.form')
                    </form>
                   
                    <hr class="my-4">

                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->

@endsection

<!--Page Active Scripts(used by this page)-->
<script src="{{ url('backEnd/dist/js/pages/forms-basic.active.js')}}"></script>
<!--Page Scripts(used by all page)-->
<script src="{{ url('backEnd/dist/js/sidebar.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
 $(document).ready(function(){
  $("#aircraft_name").change(function(){
    var air_id =  $(this).val();
    $("#aircraft_id").val(air_id );
  });
}); 
</script>
