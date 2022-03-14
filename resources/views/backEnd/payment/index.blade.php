
@extends('backEnd.layouts.layout') @section('backEnd_content')

<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
      <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
			<li class="breadcrumb-item"><h5><b>Total Received</b> = <span>Rs.{{ number_format($totalreceived)}}/-</h5></span>
    </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Home</h1>
                <small>Outstanding
                Received</small>
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
                            
                            <th>Invoice No</th>
                            <th> Client</th>
                            <th>Payment Mode</th>
                            <th>Transaction Id</th>
							   <th>Invoice Amount</th>
                            <th>Amount Received</th>
                            <th>Date of Invoice</th>
                            {{-- <th>Edit</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentDatas as $paymentData)
                        <tr>
                           @php
                        $invoiceid = App\Models\Invoice::select('id')->where('invoice_id',$paymentData->invoiceid)->first()->id;
                           @endphp
                            <td><a href="{{url('/invoiceview/'.$invoiceid )}}" >{{$paymentData->invoiceid }}</a></td>
                            <td>{{$paymentData->client_name ??''}}</td>
                            <td>@if($paymentData->paymentmode ==  0)
                                <span >Bank</span>
                                @elseif($paymentData->paymentmode ==  1)
                                <span >Online</span>
                                @else
                                <span>Cheque</span>
                                @endif
                            </td>
                                <td>{{$paymentData->transaction_id }}</td>
							 <td>{{$paymentData->total }}</td>
                             <td>{{$paymentData->amountreceived + $paymentData->tds + $paymentData->roundoff + $paymentData->tdscgst
                                + $paymentData->tdsigst + $paymentData->tdssgst}}</td>
                            <td>{{ date('F d,Y', strtotime($paymentData->invoicedate)) }}</td>
						
                         {{-- <td>  <a href="{{route('client.edit', $paymentData->id)}}"  class="btn btn-info-soft btn-sm"><i
                                class="far fa-edit"></i></a></td> --}}
                        
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/.body content-->

@endsection


