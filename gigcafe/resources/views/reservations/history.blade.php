@extends('layouts.history')

@section('links')
        <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

@section('content')
<section class="banner kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container">
    @if (session('success'))
    <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
        {{ session('success') }}
    </div>
    @endif
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="container w-full px-5 py-6 mx-auto">
        <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <h6 class="d-flex justify-content-center menu-title">
            YOUR RESERVATION HISTORY
            <!--span style="color: #FF8C00; margin-left: 5px;">RESERVATION</span-->
            <!--span style="color: #dc3545; margin-left: 5px;">HISTORY</span-->
        </h6>
            <br>
        </div>
        </table>
        <hr class="my-4 gradient-hr">
        <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <div class="table-responsive">
                <div class="table table-hover table-container ">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700 ">
                            <tr>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Details
                                </th>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    <strong>Reso_ID</strong>
                                </th>
                                <th scope="col" class="px-4 px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Date
                                </th>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Time
                                </th>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Payment Mode
                                </th>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    ₱ay Now
                                </th>
                                <th scope="col" class="px-4 py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class=" d-flex ">
                                    <a href="#" class="view-details btn-sm" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                        <i class="fas fa-eye px-3 py-1 custom-red-icon" style="font-size: 17px;"></i> 
                                    </a>
                                </div>
                                </td>
                                <td class="py-3 px-3 text-sm font-medium text-gray-900  dark:text-white">
                                <a href="#" class="view-details my-md-1 px-2 py-1 btn-sm primary-btn" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                #{{ $reservation->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-eye my-md-1 px-2 py-1 " style="font-size: 15px;"></i>&nbsp; 
                                </a>
                                </td>
                                <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="my-md-1 px-2 py-1">{{ $reservation->res_date->toDateString() }}</div>
                                </td> <!-- Display date -->
                                <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="my-md-1 px-2 py-1">{{ $reservation->res_date->toTimeString() }}</div>
                                </td>
                                <td class="py-3 px-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                    <div class="status-container {{ 
                                        $reservation->status == 'Fulfilled' || $reservation->status == 'Approved' ? 'success' : '' 
                                    }}{{ 
                                        $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'failed' : '' 
                                    }}{{ 
                                        $reservation->status == 'In Progress' || $reservation->status == 'Not fulfilled' ? 'warning' : '' 
                                    }}{{ 
                                        $reservation->status == 'Pending' ? 'pending' : '' 
                                    }}">
                                        {{ $reservation->status }}
                                    </div>
                                </td>

                                <style>
                                    .status-container {
                                        padding: 5px 10px;
                                        font-size: 12px;
                                        font-weight: bold;
                                        border-radius: 20px;
                                        text-align: center;
                                    }

                                    .success {
                                        background-color: #4CAF50;
                                        color: white;
                                        box-shadow: 0px 2px 4px rgba(76, 175, 80, 0.2);
                                    }

                                    .failed {
                                        background-color: #F44336;
                                        color: white;
                                        box-shadow: 0px 2px 4px rgba(244, 67, 54, 0.2);
                                    }

                                    .warning {
                                        background-color: #FFC107;
                                        color: #333;
                                        box-shadow: 0px 2px 4px rgba(255, 193, 7, 0.2);
                                    }

                                    .pending {
                                        background-color: #2196F3;
                                        color: white;
                                        box-shadow: 0px 2px 4px rgba(33, 150, 243, 0.2);
                                    }
                                </style>

                                <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="mt-1 px-2 alert 
                                    {{ $reservation->payment_status == 'Fully Payment' ? 'alert-success' : '' }} 
                                    {{ $reservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }}
                                    {{ $reservation->payment_status == 'Pay in Restaurant' || $reservation->payment_status == 'Not Paid' ? 'alert-failed' : '' }}">
                                    &nbsp;&nbsp;{{ $reservation->payment_status }}&nbsp;&nbsp;
                                </div>
                                </td> 
                
                                <td class="py-3 px-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="d-flex">
                                        <a href="#" class="view-details btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $reservation->id }}">
                                            <i class="fas fa-money-bill-wave px-3 py-1 alert-paypal" style="font-size: 17px; animation: warning 2s infinite;"></i> 
                                        </a>
                                    </div>
                                </td>

                                <style>
                                    @keyframes warning {
                                        0%, 100% {
                                            transform: translateX(0);
                                        }
                                        50% {
                                            transform: translateX(-5px);
                                        }
                                    }
                                </style>

                                <td class="py-3 px-3 text-sm font-medium text-right ">
                                <div class="flex space-x-2">
                                    @if($reservation->rating)
                                        <button class="py-2 px-4 bg-gray-500 rounded-lg text-white rated-btn" data-reservation-id="{{ $reservation->id }}">Rated</button>
                                    @elseif($reservation->status == 'Pending')
                                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">Cancel</button>
                                    </form>
                                    @elseif($reservation->status == 'Fulfilled' && !$reservation->rating)
                                        <button class="py-2 px-4 bg-green-500 hover:bg-green-700 rounded-lg text-white rate-btn" data-reservation-id="{{ $reservation->id }}" data-service-id="{{ $reservation->service_id }}" data-package-id="{{ $reservation->package_id }}">Rate</button>
                                    @endif
                                </div> 
                                </td>
                            </tr>

                    <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content modal-body p-4 bg-light custom-modal-body">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $reservation->status }} Reservation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h2 class="text-center">MAKE YOUR PAYMENT</h2>
                                                <p class="text-center text-danger" style="font-size: 10px; text-transform: uppercase; animation: pulse 1s infinite;">
                                                <p class="text-center" style="font-size: 10px; text-transform: uppercase; color: darkred; position: relative;">
                                                    Always! Remember your Reso ID: #{{ $reservation->id }}
                                                </p>

                                                <hr class="my-4">
                                                <div class="container">
                                                    <div class="bg-gray-50 rounded-lg shadow-xl p-4">
                                                        <div class="bg-white rounded-lg p-4">
                                                            <div class="d-flex justify-content-center">
                                                            <div class="rounded-full p-2 mt-1 status-container {{ 
                                                                $reservation->status == 'Fulfilled' || $reservation->status == 'Approved' ? 'success' : '' 
                                                            }}{{ 
                                                                $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'failed' : '' 
                                                            }}{{ 
                                                                $reservation->status == 'In Progress' || $reservation->status == 'Not fulfilled' ? 'warning' : '' 
                                                            }}{{ 
                                                                $reservation->status == 'Pending' ? 'pending' : '' 
                                                            }}">
                                                                <div class="status-text">Your Reservation is {{ $reservation->status }}!</div>
                                                            </div>

                                                            <style>
                                                                .status-container {
                                                                    padding: 10px 20px;
                                                                    font-size: 14px;
                                                                    font-weight: bold;
                                                                    border-radius: 20px;
                                                                    text-align: center;
                                                                    animation: pulse 1.5s ease infinite;
                                                                }

                                                                .status-text {
                                                                    text-transform: uppercase;
                                                                }

                                                                .success {
                                                                    background-color: #4CAF50;
                                                                    color: white;
                                                                    box-shadow: 0px 4px 8px rgba(76, 175, 80, 0.2);
                                                                }

                                                                .failed {
                                                                    background-color: #F44336;
                                                                    color: white;
                                                                    box-shadow: 0px 4px 8px rgba(244, 67, 54, 0.2);
                                                                }

                                                                .warning {
                                                                    background-color: #FFC107;
                                                                    color: #333;
                                                                    box-shadow: 0px 4px 8px rgba(255, 193, 7, 0.2);
                                                                }

                                                                .pending {
                                                                    background-color: #2196F3;
                                                                    color: white;
                                                                    box-shadow: 0px 4px 8px rgba(33, 150, 243, 0.2);
                                                                }

                                                                @keyframes pulse {
                                                                    0% {
                                                                        transform: scale(1);
                                                                        opacity: 1;
                                                                    }
                                                                    50% {
                                                                        transform: scale(1.05);
                                                                        opacity: 0.8;
                                                                    }
                                                                    100% {
                                                                        transform: scale(1);
                                                                        opacity: 1;
                                                                    }
                                                                }
                                                            </style>

                                                            </div>
                                                            <br>
                                                            <form action="{{ url('charge') }}" method="post" id="paymentForm">
                                                                @csrf
                                                                <div class="dropdown-divider bold-divider"></div>
                                                                <label for="amount" class="form-text text-xs font-small">Reso ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                <label for="amount" class="form-text text-xs font-small">Your payment mode.</label>
                                                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text alert-warning">&nbsp;#{{ $reservation->id }}&nbsp;</span>
                                                                    <span class="input-group-text alert-complete">&nbsp;&nbsp;&nbsp;{{ $reservation->payment_status }}&nbsp;&nbsp;&nbsp;</span>
                                                                </div>
                                                                @if($reservation->payment_status !== 'Pay in Restaurant')
                                                                <div class="dropdown-divider"></div>

                                                                <input type="radio" id="gcash_radio" name="payment_option" value="gcash">
                                                                <label for="gcash_radio" class="form-text text-xs font-small"> <img src="/images/gcash.png" alt="GCash" style="width: 70px; height: 18px; margin-right: 5px;"></label>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="radio" id="paypal_radio" name="payment_option" value="paypal">
                                                                <label for="paypal_radio" class="form-text text-xs"><img src="/images/paypal.png" alt="PayPal" style="width: 70px; height: 18px; vertical-align: middle; margin-right: 5px;"></label>

                                                                <div class="dropdown-divider"></div>

                                                                <div id="gcash_payment_section" class="payment-section">
                                                                <label for="gcash_radio" class="form-text text-xs font-small">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    (Click me for QR)
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text alert-info text-xs">
                                                                        <strong>Scan for GCash Payment</strong>
                                                                    </span>
                                                                    <button class="gcash-btn input-group-text" type="button" data-bs-toggle="modal" data-bs-target="#gcashModal">
                                                                        <img src="/images/gcash.png" alt="GCash" style="width: 70px; height: 18px; margin-right: 5px;">
                                                                    </button>
                                                                </div>
                                                            </div>

                                                                

                                            
                                                                <div id="paypal_payment_section" class="payment-section">
                                                                <label for="paypal_radio" class="form-text text-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    (Enter Amount for Paypal payment)</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" style="padding: 0;">
                                                                            &nbsp;<img src="/images/paypal.png" alt="PayPal" style="width: 70px; height: 18px; vertical-align: middle; margin-right: 5px;">
                                                                        </span>

                                                                        <input type="text" class="form-control" name="amount" value="₱" />
                                                                        <button class="paypal-btn input-group-text" type="submit" name="submit" value="Pay Now">
                                                                            &nbsp;<img src="/images/paypal-logo.jpg" alt="PayPal" style="width: 30px; height: 18px; vertical-align: middle; margin-right: 5px;">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <div class="dropdown-divider"></div>

                                                                @if($reservation->payment_status !== 'Pay in Restaurant')
                                                                <div class="d-flex justify-content-center">
                                                                <div class="half alert-info" style="margin-top: 5px;">
                                                                    <strong style="text-transform: uppercase;">
                                                                        &nbsp;&nbsp; We accept half downpayment.&nbsp;&nbsp;
                                                                    </strong>
                                                                </div>
                                                                <style>
                                                                    .half {
                                                                        animation: fadeInColorChange 5s ease-out infinite;
                                                                    }

                                                                    @keyframes fadeInColorChange {
                                                                        0% {
                                                                            opacity: 1;
                                                                            background-color: rgba(255, 105, 97, 0.4);
                                                                        }
                                                                        50% {
                                                                            opacity: 2;
                                                                            background-color: rgba(255, 165, 0, 0.6);
                                                                        }
                                                                        100% {
                                                                            opacity: 1;
                                                                            background-color: rgba(144, 238, 144, 0.8);
                                                                        }
                                                                    }
                                                                </style>
                                                                </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="form-text text-xs" style="margin-top: 0px;">
                                                                            Please enter the amount for PayPal.
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="form-text text-xs" style="margin-top: 0px;">
                                                                            Scan the QR code for GCash.
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="d-flex justify-content-center">
                                                                    <div class="half alert-info">
                                                                        <strong style="text-transform: uppercase; font-size: 13px;">&nbsp;
                                                                            Payment required at the Restaurant. &nbsp;
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="form-text text-xs" style="margin-top: 0px;">
                                                                            No need to pay online.
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark btn-md mr-auto" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .payment-section {
                                            display: none;
                                        }

                                        #gcash_radio:checked ~ #gcash_payment_section,
                                        #paypal_radio:checked ~ #paypal_payment_section {
                                            display: block;
                                        }
                                    </style>

                               <!-- Modal for viewing reservation details -->
                                <div class="modal fade" id="viewReservation{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReservation{{ $reservation->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-body p-4 bg-light custom-modal-body">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewReservation{{ $reservation->id }}Label">Reservation Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4 bg-light custom-modal-body">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('reservations.pdf', $reservation->id) }}" class="btn btn-dark btn-md mr-auto">
                                                        <i class="fa fa-download" style="font-size: 15px;"></i>
                                                    </a>
                                                </div>

                                                <div class="dropdown-divider bold-divider"></div>

                                                <div class="reservation-info">
                                                    <div class="info-item">
                                                        <span class="info-label">Reso ID:</span> <span class="info-value"><strong>#{{ $reservation->id }}</strong></span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Name:</span> <span class="info-value">{{ $reservation->first_name }} {{ $reservation->last_name }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Email:</span> <span class="info-value">{{ $reservation->email }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Mobile No.:</span> <span class="info-value">{{ $reservation->tel_number }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Date:</span> <span class="info-value">{{ $reservation->res_date->toDateString() }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                    <span class="info-label">Time:</span> 
                                                        <span class="info-value">{{ $reservation->res_date->format('h:i A') }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Service:</span> <span class="info-value">{{ $reservation->service ? $reservation->service->name : 'No service associated' }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Package:</span> <span class="info-value">{{ $reservation->package ? $reservation->package->name : 'No package associated' }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Guests:</span> <span class="info-value">{{ $reservation->guest_number }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Supply:</span> <span class="info-value">{{ $reservation->inventory_supplies ? $reservation->inventory_supplies : 'No supplies associated' }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Status:</span> <span class="info-value mt-2 {{ $reservation->status == 'Fulfilled' || $reservation->status == 'Approved' ? 'px-2 alert alert-success' : 'px-2 alert alert-warning' }}
                                                        {{ $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'px-2 alert alert-failed' : 'px-2 alert alert-warning' }}">{{ $reservation->status }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <span class="info-label">Payment Status:</span> <span class=" info-value mt-2 px-2 alert 
                                                        {{ $reservation->payment_status == 'Fully Payment' ? 'alert-success' : '' }} 
                                                        {{ $reservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }}
                                                        {{ $reservation->payment_status == 'Pay in Restaurant' ? 'alert-failed' : '' }}">{{ $reservation->payment_status }}</span>
                                                    </div>
                                                    <!--div class="info-item">
                                                        <span class="info-label">Status:</span>
                                                        <select id="reservationStatus{{ $reservation->id }}" class="form-control">
                                                            @foreach(\App\Enums\ReservationStatus::cases() as $status)
                                                                <option value="{{ $status->value }}" {{ $reservation->status === $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div-->
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-dark btn-md mr-auto" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!-- GCash Modal -->
<div class="modal fade" id="gcashModal" tabindex="-1" aria-labelledby="gcashModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gcashModalLabel">GCash Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please scan the QR code or follow the instructions to complete your GCash payment.</p>
                <img src="/images/gcash.png" alt="GCash QR Code" style="width: 100%; max-width: 200px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" odata-bs-dismiss="modal" onclick="refreshPage()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End GCash Modal -->


<!-- Rating Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="RateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editModalLabel">Rate Reservation</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Hidden fields to store reservation and rating data -->
                <input type="hidden" id="reserv_id" name="reserv_id">
                <input type="hidden" id="serviceId" name="service_id">
                <input type="hidden" id="packageId" name="package_id">

                <!-- Service Rating -->
                <div class="form-group">
                    <label>Service</label><br>
                    <div class="stars" id="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0"> 
                </div>

                <!-- Food Rating -->
                <div class="form-group">
                    <label>Food</label><br>
                    <div class="stars" id="qualityStars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" name="qualityRating" id="qualityRating" value="0"> 
                </div>

                <!-- Overall Rating Display -->
                <hr>
                <div class="form-group">
                    <label>Overall Rating:</label>
                    <span id="averageRating"></span>
                    <div id="overallRatingStars" class="stars"></div>
                </div>

                <!-- Comments Section -->
                <div class="form-group">
                    <label>Comments:</label>
                    <textarea id="comment" class="form-control" rows="3" required></textarea>
                    <small id="commentError" class="text-danger" style="display: none;">Please enter a comment.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="submitRating">Submit</button>
            </div>
        </div>
    </div>
</div>



<script>
function refreshPage() {
    // Reload the page
    window.location.reload();
}
    // Reset modal fields
    function resetModalFields() {
        $('#stars .star').removeClass('selected');
        $('#qualityStars .star').removeClass('selected');
        $('#rating').val('0');
        $('#qualityRating').val('0');
        $('#comment').val('');
        $('#commentError').hide();
        $('#overallRatingStars').empty();
        $('#averageRating').text('');
    }

    $(document).ready(function () {
        // Show rating modal and populate hidden fields
        $('.rate-btn').click(function () {
            var reservationId = $(this).data('reservation-id');
            var serviceId = $(this).data('service-id');
            var packageId = $(this).data('package-id');

            $('#reserv_id').val(reservationId);
            $('#serviceId').val(serviceId);
            $('#packageId').val(packageId);

            resetModalFields(); // Reset modal fields before showing
            $('#rateModal').modal('show');
        });

        // Service rating click event
        $('#stars .star').click(function () {
            var rating = $(this).data('value');
            $('#rating').val(rating);
            $('#stars .star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');
            updateOverallRating();
        });

        // Food quality rating click event
        $('#qualityStars .star').click(function () {
            var qualityRating = $(this).data('value');
            $('#qualityRating').val(qualityRating);
            $('#qualityStars .star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');
            updateOverallRating();
        });

        // Calculate and update overall rating
        function updateOverallRating() {
            var serviceRating = parseInt($('#rating').val());
            var qualityRating = parseInt($('#qualityRating').val());
            var averageRating = (serviceRating + qualityRating) / 2;

            $('#overallRatingStars').empty();
            for (var i = 1; i <= 5; i++) {
                var starClass = i <= averageRating ? 'selected' : '';
                $('#overallRatingStars').append('<span class="star ' + starClass + '">&#9733;</span>');
            }
            $('#averageRating').text(averageRating.toFixed(1));
        }

        // Ajax setup with CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Submit rating via AJAX
        $('#submitRating').click(function () {
            var reservationId = $('#reserv_id').val();
            var serviceId = $('#serviceId').val();
            var packageId = $('#packageId').val();
            var serviceRating = $('#rating').val();
            var packageRating = $('#qualityRating').val();
            var comment = $('#comment').val();

            if (comment.trim() === '') {  // Use trim to check for only whitespace
                $('#commentError').show();
                return;
            } else {
                $('#commentError').hide();
            }

            if (serviceRating === '0' || packageRating === '0') {  // Ensure a rating has been selected
                alert('Please rate both Service and Food.');
                return;
            }

            $.ajax({
                url: '{{ route("submit_rating") }}',
                method: 'POST',
                data: {
                    reserv_id: reservationId,
                    service_id: serviceId,
                    package_id: packageId,
                    service_rating: serviceRating,
                    package_rating: packageRating,
                    comment: comment
                },
                success: function (response) {
                    $('#rateModal').modal('hide');
                    resetModalFields();
                    location.reload();  // Reload page to reflect changes
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while submitting your rating. Please try again.');
                }
            });
        });
    });
</script>

</section>
@endsection
