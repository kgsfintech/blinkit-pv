
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
   
    <div class="col-sm-12 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-user-add-outline"></i></div>
            <div class="media-body">
               <a href="{{url('home')}}"> <h1 class="font-weight-bold" style="color:black;">Home</h1></a>
                <small>Target List</small>
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
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                           
                            <th>Startup Name</th>
                            <th>Category </th>
							 <th>Sub Category</th>
                            <th>Raising ₹MM </th>
							<th>Offered stake</th>
                            <th>Location of the Headquarter</th>
                            <th>Deck </th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($targetDatas as $targetData)
                        <tr>
                            <td><a href="{{url('view/target', $targetData->id)}}" >{{ $targetData->startup_name ??'' }}</a></td>
                            <td>{{ $targetData->category  ??''}}</td>
                            <td>{{ $targetData->subcategory  ??''}}</td>
                            <td>{{ $targetData->capital_req  ??''}}</td>
                            <td>{{ $targetData->offered_stake  ??''}}</td>
                            <td>{{ $targetData->headquarter_location  ??''}}</td>
                            <td>{{ $targetData->deck  ??''}}</td>
                            <td>{{ date('F d,Y', strtotime($targetData->created_at)) }}</td>

                           
                      
                      
                            
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->

@endsection


