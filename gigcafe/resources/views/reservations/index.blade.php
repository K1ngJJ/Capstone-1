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
        
    </style>

    <section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
        <div class="container mt-lg-0 mt-5">
            <h2 class="mt-5 mb-4" style="font-size: 1.0rem;font-style: italic;">Catering Reservations</h2>
        <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
    <!--Filter Reservations-->
        <div class="dropstart w-100 d-flex justify-content-right">    
            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                Filter <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu">
                <form method="get" action="{{ route('filterReservation') }}" class="px-4 py-3" style="min-width: 350px">    
                    <div class="mb-2">
                        <label for="id" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">ID</label>
                        <input type="text" name="id" class="form-control text-xs font-small" id="id" placeholder="Enter ID">
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="startDate" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">From Date</label>
                            <label for="endDate" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">To Date</label>
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
                            <label for="startTime" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">From Time</label>
                            <label for="endTime" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">To Time</label>
                        </div>
                        <div class="input-group">
                            <input type="time" name="startTime" class="form-control text-xs font-small" placeholder="Start Time" aria-label="Start Time">
                            <span class="input-group-text">~</span>
                            <input type="time" name="endTime" class="form-control text-xs font-small" placeholder="End Time" aria-label="End Time">
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="col-12 mb-3">
                        <label for="status" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Status</label>
                        <select name="status" class="form-control text-xs font-small" id="status">
                            <option value=""  disabled selected>Select Status</option>
                            <option value="Fulfilled">Fulfilled</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="payment_status" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Payment Status</label>
                        <select name="payment_status" class="form-control text-xs font-small" id="payment_status">
                            <option value=""  disabled selected>Select Status</option>
                            <option value="Fully Payment">Fully Payment</option>
                            <option value="Down Payment ">Down Payment </option>
                            <option value="Pay in Restaurant">Pay in Restaurant</option>
                        </select>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="col-12 mb-3">
                        <label for="service" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Service</label>
                        <select name="service" class="form-control text-xs font-small" id="service">
                            <option value=""  disabled selected>Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="col-12 mb-3">
                        <label for="package" class="py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Package</label>
                        <select name="package" class="form-control text-xs font-small" id="package">
                            <option value=""  disabled selected>Select Package</option>
                            @foreach($packages as $package)
                                <option value="{{ $package->name }}">{{ $package->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dropdown-divider col-12 mb-3"></div>

                    <button type="submit" class="btn btn-outline-dark btn-md">Filter</button>
                </form>
            </div>
        </div>
    <!-- End Filter Reservations-->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col">
                                <div class="px-4">Reso ID</div></th>
                            <th scope="col">
                                <div class="px-4">Date</div></th>
                            <th scope="col">
                                <div class="px-4">Time</div></th>
                            <th scope="col">
                                <div class="px-4">Status</div></th>
                            <th scope="col">
                                <div class="px-4">Payment Mode</div></th>
                            <!--th scope="col">Service</th>
                            <th scope="col">Package</th>
                            <th scope="col">Supply</th>
                            <th scope="col">Guests</th-->       
                            <th scope="col">
                                <div class="px-4">
                            <a href="{{ route('ReservationsTxn.Pdf') }}" class="btn btn-dark btn-sm" id="pdfDownloadBtn"><i class="fa fa-download"></i></a>
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

                            <a href="{{ route('reservations.create') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                        <tr>
                            <th class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#" class="view-details my-md-1 px-2 py-1 btn-sm primary-btn" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                #{{ $reservation->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-eye my-md-1 px-2 py-1 " style="font-size: 15px;"></i>&nbsp; 
                                </a>
                            </th>
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
                            <!--td>{{ $reservation->service ? $reservation->service->name : 'No service associated' }}</td>
                            <td>{{ $reservation->package ? $reservation->package->name : 'No package associated' }}</td>
                            <td class="email">{{ $reservation->inventory_supplies }}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $reservation->guest_number }}</-->
                            <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class=" d-flex ">
                                    <a href="#" class="view-details btn-sm" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                        <i class="fas fa-eye px-3 py-1 custom-red-icon" style="font-size: 17px;"></i> 
                                    </a>
                                    @if(!in_array($reservation->status, ['Approved', 'In Progress', 'Fulfilled']))
                                        <button type="button" class="my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">
                                            <i class="fa fa-trash" style="font-size: 17px;"></i>
                                        </button>
                                    @endif
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

                                            @if($reservation->status !== 'Fulfilled')
                                                <button onclick="window.location.href='{{ route('reservations.edit', $reservation->id) }}'" class="btn-md btn btn-warning ml-auto">
                                                    <i class="fa fa-edit" style="font-size: 20px;"></i>
                                                </button>
                                            @endif
                                        </div>

                                        <div class="dropdown-divider bold-divider"></div>

                                        <div class="reservation-info">
                                            <div class="info-item">
                                                <span class="info-label">Reso ID:</span> <span class="info-value"><strong>{{ $reservation->id }}</strong></span>
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

<script>
document.getElementById('pdfDownloadBtn').addEventListener('click', function() {
   // Show loading modal
   $('#loadingModal').modal('show');
    // Show loading style (e.g., spinner)
    // You can add your loading animation here
    
    // Optionally, you can add a delay before starting the download
    // setTimeout(function() {
    //     // Start the download
    //     window.location.href = "{{ route('ReservationsTxn.Pdf') }}";
    // }, 1000); // 1000 milliseconds delay

    // Or, you can directly start the download without delay
    window.location.href = "{{ route('ReservationsTxn.Pdf') }}";

    // To prevent the default behavior (i.e., following the link) and handle the download manually
    // You can uncomment the following line if you want to prevent the default behavior
    // return false;
});
</script>



    @endsection

    
