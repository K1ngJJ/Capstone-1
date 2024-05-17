@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'previousOrder' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<style>

.btn-danger {
    background-color: black; 
    color: white;
    border: gray;
}

.btn-complete {
    background-color: red; 
    color: white;
    border: gray;
} 

.btn-warning {
    background-color: orange; 
    color: white;
    border: gray;
} 

.btn-success {
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}


.modal-body {
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .reservation-info h5 {
        font-size: 1.25rem;
        color: #007bff;
    }
    .reservation-info .table {
        margin-bottom: 0; /* Remove margin below the table */
    }
    .reservation-info .table th {
        background-color: #f1f1f1; /* Light grey background for table headers */
        font-weight: 600; /* Bold headers */
    }
    .reservation-info .table td, .reservation-info .table th {
        padding: 0.75rem;
    }.custom-modal-body {
        border-radius: 15px;
        background-color: #fdfdfd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .reservation-info h5 {
        font-size: 1.5rem;
        color: #007bff;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: bold;
        color: #495057;
    }
    .info-value {
        color: #212529;
    }

</style>

@if (!$previousOrders->count())
<!-- no previous orders -->
<section class="empty-order min-vh-100 flex-center pt-5">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="hero-wrapper">
            <img src="{{ URL::asset('/images/empty_order.svg') }}" alt="">
        </div>
        <h3 class="mt-4 mb-2">No Previous Orders Yet.</h3>
        <p class="text-muted">There seems to be no previous customer orders for now...</p>
        <div class="d-flex mt-3">
            <a href="{{ route('kitchenOrder') }}" class="primary-btn mx-3">Active Orders</a>
            <a href="{{ route('dashboard') }}" class="primary-btn mx-3">View Dashboard</a>
        </div>
    </div>
</section>
@else
<section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container mt-lg-0 mt-5">
        <h2 class="mt-5 mb-4">Previous Orders</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Final Price</th>
                    <th scope="col">
                        Status &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-dark btn-sm" href="{{ route('OrdersTxn.Pdf') }}" download><i class="fa fa-download"></i><a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($previousOrders as $order)
                    <tr>
                         <td>
                            <a href="#" class="view-details" data-toggle="modal" data-target="#viewOrderModal{{ $order->id }}">
                            <i class="fas fa-eye"></i>
                        </td>
                        <th scope="row"><a href="{{ route('specificKitchenOrder', $order->id) }}">#{{ $order->id }}</a></th>
                        <td>{{ $order->getOrderDate() }}</td>
                        <td>{{ $order->getOrderTime() }}</td>
                        <td>₱ {{ $order->getTotalFromScratch() }}</td>
                        <td>
                            @if ($order->completed)
                                <div class="px-3 alert alert-success">
                                    Fulfilled
                                </div>  
                            @else
                                <div class="px-3 alert alert-warning">
                                    Not fulfilled
                                </div>  
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-md-5 mt-4 mb-5 d-flex flex-md-row flex-column justify-content-md-between">
            <a href="{{ route('kitchenOrder') }}" class="primary-btn">Active Orders</a>
            <div class="col-md-8 col-12 d-flex justify-content-md-end justify-content-center">
            {{ $previousOrders->links() }}
            </div>
        </div>
    </div>
</section>
@endif

<!-- Modal markup -->
@foreach ($previousOrders as $order)
<div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="viewOrderModal{{ $order->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderModal{{ $order->id }}Label">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 bg-light custom-modal-body">
                <div class="reservation-info">
                    <div class="info-item">
                        <span class="info-label">ID:</span> <span class="info-value">#{{ $order->id }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Customer:</span> <span class="info-value">{{ $order->user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span> <span class="info-value">{{ $order->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Mobile Number:</span> <span class="info-value">{{ $order->user->mobile_number }}</span>
                    </div>
                    <!-- Add other order details here -->
                    <!-- Example: -->
                    <div class="info-item">
                        <span class="info-label">Date:</span> <span class="info-value">{{ $order->getOrderDate() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Time:</span> <span class="info-value">{{ $order->getOrderTime() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Final Price:</span> <span class="info-value">₱ {{ $order->getTotalFromScratch() }}</span>
                    </div>
                    <!-- End of example -->
                </div>
            </div>
            <div class="modal-footer">
            <a href="{{ route('transactions.pdf', $order->transaction->id) }}" class="btn btn-dark btn-sm">
                        <i class="fa fa-download"></i> Download PDF
                    </a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

