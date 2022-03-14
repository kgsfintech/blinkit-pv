<link href="{{ url('backEnd/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@extends('backEnd.layouts.layout') @section('backEnd_content')

<div class="body-content">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Edit tender</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('tender.update', $tender->id)}}"  enctype="multipart/form-data">
                        @method('PATCH') 
                        @csrf            
                        @component('backEnd.components.alert')

                        @endcomponent   
                    @include('backEnd.tender.form')
                </form>
                    <hr class="my-4">

                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->

@endsection
