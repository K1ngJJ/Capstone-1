@extends('layouts.app')

@section('links')
        <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('navTheme')
{{ 'dark' }}@endsection

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

        .btn-success {
            color: green;
            background-color: transparent; /* Setting the background-color to transparent */
            border-color: green; /* Adding border color for better visibility */
        }

        .btn-success:hover {
            background-color: white; /* Changing background color on hover */
            color: white; /* Changing text color on hover */
        }

        .bold-divider {
            font-weight: bold; /* Make text bold */
            height: 2px; /* Increase height to make the line bolder */
            background-color: black; /* Ensure the line is visible */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .custom-status-span {
            background-color: maroon; /* Red background */
            color: white; /* White text */
            padding: 0.25rem 0.5rem; /* Padding for some spacing */
            font-size: 0.75rem; /* Small font size */
            font-weight: bold; /* Bold text */
            text-transform: uppercase; /* Uppercase text */
            letter-spacing: 0.05em; /* Tracking wider */
            border-color: white;
        }

        .custom-red-icon {
            color: black; /* Red color */
            border: 2px solid darkred; /* Red border */
            padding: 4px; /* Padding for spacing between border and icon */
            border-radius: 5px; /* Rounded corners */
            transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
        }

        .custom-red-icon:hover {
            color: white; /* Change icon color on hover */
            border-color: white; /* Change border color on hover */
            background-color: darkred; /* Add background color on hover */
        }

        .alert-failed{
            color: #400200; 
            border: 1px solid #C54644;
            padding: 4px;
            border-radius: 5px;
            background-color: #f3d3d9;
        }

        .alert-pending{
            color: solid lightgray; 
            border: 1px solid gray;
            padding: 4px;
            border-radius: 5px;
            background-color: lightgray;
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
        
        .menu-title {
            text-align: center;
            font-style: italic;
            color: black;
            font-size: 30px;
        }

        .bg-custom-color {
            background-color: #CE3232;
        }

        .bg-custom-color:hover {
            background-color: #dfe1e2;
            transition-duration: 0.8s;
        }

        .text-custom {
            color: white;
        }

        .text-custom:hover {
            color: black;
            transition-duration: 0.8s;
        }

        .table-container {
            overflow-x: auto; 
            max-width: 100%; 
        }

        .modal-footer .btn-primary {
            background-color: #ce3232; 
            border-color: #ce3232;
        }

        .modal-footer .btn-danger {
            background-color: black;
            border-color: black;
        }

        .modal-footer .btn-primary:hover {
            background-color: black;
            border-color: black;
        }

        .stars {
            display: inline-block;
            font-size: 40px; 
            cursor: pointer;
        }

        .star {
            color: #ddd; 
        }

        .star.selected {
            color: gold; 
        }
        
        .alert-complete {
            background-color: darkred;
            color: white; /* Red color */
            border: 2px solid black; /* Red border */
            padding: 4px; /* Padding for spacing between border and icon */
            border-radius: 5px; /* Rounded corners */
            transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
        } 

        .alert-complete:hover {
            background-color: white; /* Changing background color on hover */
            color: black; /* Changing text color on hover */
            border: 2px solid darkorange; /* Red border */
        }

        .alert-paypal {
            background-color: #436b95;
            color: white; /* Red color */
            border: 2px solid #1c2841; /* Red border */
            padding: 4px; /* Padding for spacing between border and icon */
            border-radius: 5px; /* Rounded corners */
            transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
        } 

        .alert-paypal:hover {
            background-color: white; /* Changing background color on hover */
            color: black; /* Changing text color on hover */
            border: 2px solid #73a9c2; /* Red border */
        }
    </style>

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
            <h6 class="d-flex justify-content-center menu-title">CATERING RESERVATION HISTORY</h2>
        <hr class="my-4">
        <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <div class="table-responsive">
                <div class="table table-hover table-container">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
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
                                <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="mt-1 {{ $reservation->status == 'Fulfilled' || $reservation->status == 'Approved' ? 'px-4 alert alert-success' : '' }}
                                                {{ $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'px-4 alert alert-failed' : '' }}
                                                {{ $reservation->status == 'In Progress' || $reservation->status == 'Not fulfilled' ? 'px-3 alert alert-warning' : '' }}
                                                {{ $reservation->status == 'Pending' ? 'px-4 alert alert-pending' : '' }}">
                                    {{ $reservation->status }}
                                </div>
                                </td>
                                <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="mt-1 px-2 alert 
                                    {{ $reservation->payment_status == 'Fully Payment' ? 'alert-success' : '' }} 
                                    {{ $reservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }}
                                    {{ $reservation->payment_status == 'Pay in Restaurant' || $reservation->payment_status == 'Not Paid' ? 'alert-failed' : '' }}">
                                    &nbsp;&nbsp;{{ $reservation->payment_status }}&nbsp;&nbsp;
                                </div>
                                </td> 
                
                                <td class="py-3 px-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class=" d-flex ">
                                    <a href="#" class="view-details btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $reservation->id }}">
                                    <i class="fas fa-money-bill-wave px-3 py-1 alert-paypal" style="font-size: 17px;"></i> 
                                    </a>
                                </div>
                                </td>
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
                                                <h2 class="text-center">MAKE YOUR PAYMENT </h2>
                                                <hr class="my-4">
                                                <div class="container">
                                                    <div class="bg-gray-50 rounded-lg shadow-xl p-4">
                                                        <div class="bg-white rounded-lg p-4">
                                                         <div class="d-flex justify-content-center">
                                                            <div class="rounded-full p-2 mt-1
                                                                {{ $reservation->status == 'Fulfilled' || $reservation->status == 'Approved' ? 'px-4 alert alert-success' : '' }}
                                                                {{ $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'px-4 alert alert-failed' : '' }}
                                                                {{ $reservation->status == 'In Progress' || $reservation->status == 'Not fulfilled' ? 'px-3 alert alert-warning' : '' }}
                                                                {{ $reservation->status == 'Pending' ? 'px-4 alert alert-pending' : '' }}">
                                                                Your Reservation is {{ $reservation->status }}!
                                                            </div>
                                                         </div>
                                                            <br>
                                                            <form action="{{ url('charge') }}" method="post" id="paymentForm">
                                                                @csrf       
                                                                    <label for="amount" class="form-label text-xs font-small">Reso ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <label for="amount" class="form-label text-xs font-small">Mode</label>
                                                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text alert-warning">#{{ $reservation->id }}</span>
                                                                    <span class="input-group-text alert-complete">{{ $reservation->payment_status }}</span>
                                                                </div>
                                                                @if($reservation->payment_status !== 'Pay in Restaurant')
                                                                <label for="amount" class="form-label text-xs">Enter Amount</label>
                                                                @endif
                                                                <div class="input-group mb-3">
                                                                    @if($reservation->payment_status !== 'Pay in Restaurant')
                                                                    <span class="input-group-text alert-success">₱</span>
                                                                    <input type="text" class="form-control" name="amount" value="0" />
                                                                    <button class="primary-btn input-group-text" type="submit" name="submit" value=" Pay Now">
                                                                        &nbsp;&nbsp;<i class='fa fa-credit-card'></i>&nbsp;&nbsp;
                                                                    </button>
                                                                   <div class="form-text text-center">We accept half downpayment. Please input the half amount.</div>
                                                                    @else
                                                                    <div class="form-text text-center">You have to pay in our restaurant. No need to pay online.</div>
                                                                    @endif

                                                                </div>
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
                                                        <span class="info-label">Time:</span> <span class="info-value">{{ $reservation->res_date->toTimeString() }}</span>
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
                                                        <span class="info-label">Supply:</span> <span class="info-value">{{ $reservation->inventory_supplies }}</span>
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

                      <!-- Rating Modal -->
                      <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="RateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="editModalLabel">Rate Reservation</h2>
                                </div>

                                <input type="hidden" id="reserv_id" name="reserv_id">
                                <input type="hidden" id="serviceId" name="service_id">
                                <input type="hidden" id="packageId" name="package_id">
                                <div class="modal-body">
                                    <label>Service</label><br>
                                    <div class="stars" id="stars">
                                        <span class="star" data-value="1">&#9733;</span>
                                        <span class="star" data-value="2">&#9733;</span>
                                        <span class="star" data-value="3">&#9733;</span>
                                        <span class="star" data-value="4">&#9733;</span>
                                        <span class="star" data-value="5">&#9733;</span>
                                    </div>
                                    <input type="hidden" name="rating" id="rating" value="0"> 
                                    <br><label>Food </label><br>
                                    <div class="stars" id="qualityStars">
                                        <span class="star" data-value="1">&#9733;</span>
                                        <span class="star" data-value="2">&#9733;</span>
                                        <span class="star" data-value="3">&#9733;</span>
                                        <span class="star" data-value="4">&#9733;</span>
                                        <span class="star" data-value="5">&#9733;</span>
                                    </div>
                                    <input type="hidden" name="qualityRating" id="qualityRating" value="0"> 
                                    <hr>
                                    <div>
                                        <br>
                                        <label>Overall Rating:</label>
                                        <span id="averageRating"></span>
                                    </div>
                                    <div id="overallRatingStars" class="stars"></div>
                                    <br><label>Comments:</label>
                                    <textarea id="comment" class="form-control" rows="3" required></textarea>
                                    <small id="commentError" class="text-danger" style="display: none;">Please enter a comment.</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" id="submitRating">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
        </div>
    </div>
</div>

    <script>
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
        $('.rate-btn').click(function () {
            var reservationId = $(this).data('reservation-id');
            var serviceId = $(this).data('service-id');
            var packageId = $(this).data('package-id');

            $('#reserv_id').val(reservationId);
            $('#serviceId').val(serviceId);
            $('#packageId').val(packageId);

            $('#rateModal').modal('show');
        });

        $('#stars .star').click(function () {
            var rating = $(this).attr('data-value');
            $('#rating').val(rating);
            $('#stars .star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');
            updateOverallRating();
        });

        $('#qualityStars .star').click(function () {
            var qualityRating = $(this).attr('data-value');
            $('#qualityRating').val(qualityRating);
            $('#qualityStars .star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');
            updateOverallRating();
        });

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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submitRating').click(function () {
            var reservationId = $('#reserv_id').val();
            var serviceId = $('#serviceId').val();
            var packageId = $('#packageId').val();
            var serviceRating = $('#rating').val();
            var packageRating = $('#qualityRating').val();
            var comment = $('#comment').val();

            if (comment === '') {
                $('#commentError').show();
                return;
            } else {
                $('#commentError').hide();
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
                    // Optionally reload the page or update the specific row to reflect the rating
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</section>
@endsection
