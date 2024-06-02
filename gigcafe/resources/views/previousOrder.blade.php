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
    .btn-dark {
        background-color: black;
        color: white;
    } 

    .btn-dark:hover {
        background-color: white;
        color: black;
    } 

    .btn-success {
        background-color: black;
        color: white;
    } 
    .btn-success:hover {
        background-color: white;
        color: black;
    }

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
        background-color: darkorange; 
        color: white;
    } 

    .btn-warning:hover {
        background-color: white; /* Changing background color on hover */
        color: black; /* Changing text color on hover */
    }


    .bold-divider {
        font-weight: bold; /* Make text bold */
        height: 2px; /* Increase height to make the line bolder */
        background-color: black; /* Ensure the line is visible */
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .custom-red-icon {
        color: black; /* Red color */
        border: 2px solid darkred; /* Red border */
        padding: 5px; /* Padding for spacing between border and icon */
        border-radius: 4px; /* Rounded corners */
        transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
    }

    .custom-red-icon:hover {
        color: white; /* Change icon color on hover */
        border-color: white; /* Change border color on hover */
        background-color: darkred; /* Add background color on hover */
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
        <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white">
        <table class="table table-hover">
            <thead>
                  <tr>
                    <th scope="col">
                        <div class="dropstart w-100 d-flex justify-content-right">    
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">Filter <i class="fa fa-filter" aria-hidden="true"></i></button>
                            <div class="dropdown-menu">
                                <form method="get" action="{{ route('filterPreviousOrders') }}" class="px-4 py-3" style="min-width: 350px">    
                                    <div class="mb-2">
                                    <label for="DateRange" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Order ID</label>
                                        <input type="text" name="orderID" class="form-control text-xs font-small" id="orderID" placeholder="Enter Order ID">
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="DateRange" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            From Date
                                        </label>
                                        <label for="DateRange" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            To Date
                                        </label>
                                    </div>
                                        <div class="input-group">
                                            <input type="date" name="startDate" class="form-control text-xs font-small" placeholder="Start Date" aria-label="Start Date">
                                            <span class="input-group-text">~</span>
                                            <input type="date" name="endDate" class="form-control text-xs font-small" placeholder="End Date" aria-label="End Date">
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="startTime" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                From Time
                                            </label>
                                            <label for="endTime" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                To Time
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="time" name="startTime" class="form-control text-xs font-small" placeholder="Start Time" aria-label="Start Time">
                                            <span class="input-group-text">~</span>
                                            <input type="time" name="endTime" class="form-control text-xs font-small" placeholder="End Time" aria-label="End time">
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <!--div class="mb-2">
                                        <label for="orderTime" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Time</label>
                                        <input type="time" name="orderTime" class="form-control text-md font-small" id="orderTime">
                                    </div-->
                                    <!--div class="mb-2">
                                        <label for="finalPrice" class="form-label">Final Price</label>
                                        <input type="number" name="finalPrice" class="form-control" id="finalPrice" placeholder="Enter Final Price">
                                    </div-->
                                
                                    <!-- Dropdown for Dine In / Take Out -->
                                    <div class="mb-2">
                                        <label for="orderType" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Order Type</label>
                                        <select name="orderType" class="form-control text-md font-small" id="orderType">
                                            <option value="">All</option>
                                            <option value="Dine-In">Dine In</option>
                                            <option value="Take-Out">Take Out</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Sorting fields -->
                                    <input type="hidden" name="sortField" value="{{ Request::get('sortField') }}">
                                    <input type="hidden" name="sortOrder" value="{{ Request::get('sortOrder') }}">
                                    
                                    <div class="dropdown-divider col-12 mb-3"></div>

                                    <button type="submit" class="btn btn-outline-dark btn-md">Filter</button>
                                </form>
                            </div>
                        </div>
                    </th>
                    <th scope="col"><a href="{{ route('filterPreviousOrders', ['sortField' => 'id', 'sortOrder' => (Request::get('sortField') == 'id' && Request::get('sortOrder') == 'asc') ? 'desc' : 'asc']) }}">Order ID</a></th>
                    <th scope="col"><a href="{{ route('filterPreviousOrders', ['sortField' => 'dateTime', 'sortOrder' => (Request::get('sortField') == 'dateTime' && Request::get('sortOrder') == 'asc') ? 'desc' : 'asc']) }}">Date</a></th>
                    <th scope="col"><a href="{{ route('filterPreviousOrders', ['sortField' => 'dateTime', 'sortOrder' => (Request::get('sortField') == 'dateTime' && Request::get('sortOrder') == 'asc') ? 'desc' : 'asc']) }}">Time</a></th>
                    <th scope="col">Final Price</th>
                    <th scope="col">
                        Status &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-dark btn-sm" href="{{ route('OrdersTxn.Pdf') }}" id="pdfDownloadBtnOrders" data-toggle="modal" data-target="#loadingModal"><i class="fa fa-download"></i></a>
                    </th>

                    <!-- Modal -->
                    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loadingModalLabel">Preparing PDF</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Please wait while the PDF is being prepared for download...
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('pdfDownloadBtnOrders').addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent the default action

                            // Show the modal
                            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                            loadingModal.show();

                            // Start the PDF download
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', '{{ route('OrdersTxn.Pdf') }}', true);
                            xhr.responseType = 'blob';

                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                                    var link = document.createElement('a');
                                    link.href = window.URL.createObjectURL(blob);
                                    link.download = 'OrdersTxn.pdf';
                                    link.click();

                                    // Hide the modal after download starts
                                    loadingModal.hide();

                                    // Reload the page after a delay (e.g., 2 seconds)
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000); // Adjust the delay (in milliseconds) as needed
                                } else {
                                    console.error('Failed to download PDF');
                                    // Hide the modal if an error occurs
                                    loadingModal.hide();
                                }
                            };

                            xhr.onerror = function() {
                                console.error('Network error occurred');
                                // Hide the modal if a network error occurs
                                loadingModal.hide();
                            };

                            xhr.send();
                        });
                    </script>

                </tr>
            </thead>
            <tbody>
                @foreach ($previousOrders as $order)
                    <tr>
                        <td>
                            <a href="#" class="view-details" data-toggle="modal" data-target="#viewOrderModal{{ $order->id }}">
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-eye px-1 custom-red-icon" style="font-size: 20px;"></i>
                            </a>
                        </td>
                        <td><a href="{{ route('specificKitchenOrder', $order->id) }}" class="my-md-2 mt-4 mb-5 px-3 py-1 btn-sm btn-warning flex-md-row "><strong># </strong>{{ $order->id }}</a></td>
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

        </div>
    </div>
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
                <div class="d-flex justify-content-between">
                    @if ($order->transaction)
                        <a href="{{ route('transactions.pdf', $order->transaction->id) }}" class="btn btn-dark btn-sm">
                        <i class="fa fa-download" style="font-size: 15px;"></i></a>
                    @endif
                </div>

                <div class="dropdown-divider bold-divider"></div>

                <div class="reservation-info">
                    <div class="info-item">
                        <span class="info-label">Order ID:</span> <span class="info-value">#{{ $order->id }}</span>
                    </div>
                    @if ($order->user)
                        <div class="info-item">
                            <span class="info-label">Customer:</span> <span class="info-value">{{ $order->user->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span> <span class="info-value">{{ $order->user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Mobile Number:</span> <span class="info-value">{{ $order->user->mobile_number }}</span>
                        </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">Order Type:</span> <span class="info-value">{{ $order->type }}</span>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

