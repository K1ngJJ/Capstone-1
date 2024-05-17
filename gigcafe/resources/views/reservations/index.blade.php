    @extends('layouts.backend')

    @section('links')
        <link href="{{ asset('css/order.css') }}" rel="stylesheet">
    @endsection

    @section('bodyID')
    {{ 'previousOrder' }}
    @endsection

    @section('navTheme')
    {{ 'light' }}
    @endsection

    @section('logoFileName')
    {{ URL::asset('/images/Black Logo.png') }}
    @endsection

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

    <section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
        <div class="container mt-lg-0 mt-5">
            <h2 class="mt-5 mb-4">Catering Reservations</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Reso ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Service</th>
                            <th scope="col">Package</th>
                            <th scope="col">Supply</th>
                            <th scope="col">Guests</th>
                            <th scope="col">
                            <a href="{{ route('ReservationsTxn.Pdf') }}" class="btn btn-dark btn-sm" download><i class="fa fa-download"></i><a>
                            <a href="{{ route('reservations.create') }}" class="btn btn-dark btn-sm"><i class="fa fa-plus"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                        <tr>
                            <td class="mt-2 {{ $reservation->status == 'Fulfilled' || $reservation->status == 'Approved' ? 'px-2 alert alert-success' : 'px-2 alert alert-warning' }}">
                                    {{ $reservation->status }}
                                </a>
                            </td>
                            <th>
                                <a href="#" class="view-details mt-4 px-3 my-md-2 mb-5 px-2 py-1 btn-sm primary-btn" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                &nbsp;<i class="fas fa-eye" style="font-size: 15px;"></i> #{{ $reservation->id }}
                                </a>
                            </th>
                            <td>{{ $reservation->res_date->toDateString() }}</td> <!-- Display date -->
                            <td>{{ $reservation->res_date->toTimeString() }}</td>
                            <td>{{ $reservation->service ? $reservation->service->name : 'No service associated' }}</td>
                            <td>{{ $reservation->package ? $reservation->package->name : 'No package associated' }}</td>
                            <td class="email">{{ $reservation->inventory_supplies }}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $reservation->guest_number }}</td>
                            <td>
                                <div>
                                    <button type="button" class="my-md-2 mt-4 mb-5 px-3 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">
                                    <i class="fa fa-trash" style="font-size: 20px;"></i>
                                    </button>

                                    <!--form class="my-md-2 mt-4 mb-5  d-flex flex-md-row flex-column justify-content-md-between" method="POST" action="{{ route('reservations.destroy', $reservation->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="primary-btn btn-sm px-3">Delete</button>
                                    </form-->
                                    <!--button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                        View Details
                                    </button-->
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $reservation->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $reservation->id }}">Delete Reservation</h5>
                                    
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this <strong>reservation #{{ $reservation->id }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" style="font-size: 20px;"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete Modal -->

                    <!-- Modal for viewing reservation details -->
                        <div class="modal fade" id="viewReservation{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReservation{{ $reservation->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
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

                                            <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 custom-status-span">
                                                Status
                                            </span>
                                            <select id="reservationStatus{{ $reservation->id }}" class="form-control">
                                                @foreach(\App\Enums\ReservationStatus::cases() as $status)
                                                        <option value="{{ $status->value }}" {{ $reservation->status === $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                                                @endforeach
                                            </select>

                                            @if(auth()->user()->role === 'admin' || $reservation->status !== 'Fulfilled')
                                                <button onclick="window.location.href='{{ route('reservations.edit', $reservation->id) }}'" class="btn-md btn btn-warning ml-auto">
                                                    <i class="fa fa-edit" style="font-size: 20px;"></i>
                                                </button>
                                            @endif
                                        </div>

                                        <div class="dropdown-divider bold-divider"></div>

                                        <div class="reservation-info">
                                            <div class="info-item">
                                                <span class="info-label">Reso ID:</span> <span class="info-value">{{ $reservation->id }}</span>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="reservationStatus"]').forEach(function (selectElement) {
            selectElement.addEventListener('change', function () {
                const reservationId = selectElement.id.replace('reservationStatus', '');
                const newStatus = selectElement.value;

                fetch(`/reservations/${reservationId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensure you have the CSRF token for the request
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully');
                        location.reload();  // Refresh the page
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    </script>



    @endsection

    
