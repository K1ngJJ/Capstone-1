@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'previousOrder' }}
@endsection

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
    <h2 class="mt-5 mb-4" style="font-size: 1.0rem;font-style: italic;">Catering packages</h2>
    <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col">
                            <div class="px-4">Name</div></th>
                            <th scope="col">
                            <div class="px-4">Image</div></th>
                            <th scope="col">
                            <div class="px-4">Guest Limit</div></th>
                            <th scope="col">
                            <div class="px-4">Status</div></th>
                            <th scope="col">
                            <div class="px-4">Price</div></th>
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

                            <a href="{{ route('packages.create') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                            </th>       
                        </tr>
                    </thead>
                <tbody>
                                    @foreach ($package as $packages)
                                        <tr>
                                            <td
                                            class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="my-md-1 px-2 py-1">{{ $packages->name }}</div>
                                            </td>
                                            <td
                                            class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="my-md-1 px-2 py-1"><img src="{{ Storage::url($packages->image) }}" class="w-16 h-16 rounded"></div>
                                            </td>
                                            <td
                                               class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                               <div class="my-md-1 px-2 py-1">{{ $packages->guest_number }}</div>
                                            </td>
                                            <td
                                               class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                               <div class="my-md-1 px-2 py-1 {{ $packages->status->name == 'Available' ? 'px-4 alert alert-success' : '' }}
                                               {{ $packages->status->name == 'Unavailable' ? 'px-4 alert alert-warning' : '' }}">
                                               {{ $packages->status->name }}</div>
                                            </td>
                                            <td
                                               class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                               <div class="my-md-1 px-2 py-1">₱ {{ $packages->price }}</div>
                                            </td>
                                            <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class=" d-flex ">
                                                    <a href="#" class="view-details btn-sm" data-toggle="modal" data-target="#viewReservation{{ $packages->id }}">
                                                        <i class="fas fa-eye px-3 py-1 custom-red-icon" style="font-size: 17px;"></i> 
                                                    </a>
                                                    <button type="button" class="my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $packages->id }}">
                                                        <i class="fa fa-trash" style="font-size: 17px;"></i>
                                                    </button>
                                                </div>
                                            </td>    
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $packages->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $packages->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $packages->id }}">Delete packages</h5>
                                                    
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this <strong>packages #{{ $packages->id }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route( 'packages.destroy', $packages->id) }}" method="POST">
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
                        <div class="modal fade" id="viewReservation{{ $packages->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReservation{{ $packages->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewReservation{{ $packages->id }}Label">Package Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4 bg-light custom-modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('packages.pdf', $packages->id) }}" class="btn btn-dark btn-md mr-auto">
                                                <i class="fa fa-download" style="font-size: 15px;"></i>
                                            </a>

                                            <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 custom-status-span">
                                                Status
                                            </span>
                                            <select id="packageStatus{{ $packages->id }}" class="form-control">
                                                @foreach(\App\Enums\PackageStatus::cases() as $status)
                                                        <option value="{{ $status->value }}" {{ $packages->status === $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                                                @endforeach
                                            </select>

                                      
                                                <button onclick="window.location.href='{{ route('packages.edit', $packages->id) }}'" class="btn-md btn btn-warning ml-auto">
                                                    <i class="fa fa-edit" style="font-size: 20px;"></i>
                                                </button>
                                          
                                        </div>

                                        <div class="dropdown-divider bold-divider"></div>

                                        <div class="reservation-info">
                                            <div class="info-item">
                                                <span class="info-label">Name:</span> <span class="info-value"><strong>{{ $packages->name }}</strong></span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Image:</span> <span class="info-value"><img src="{{ Storage::url($packages->image) }}" class="w-16 h-16 rounded"></span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Guest Limit:</span> <span class="info-value">{{ $packages->guest_number }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Status:</span> <span class="info-value">{{ $packages->status->name }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Price:</span> <span class="info-value">₱ {{ $packages->price }}</span>
                                            </div>
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
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="packageStatus"]').forEach(function (selectElement) {
            selectElement.addEventListener('change', function () {
                const packageId = selectElement.id.replace('packageStatus', '');
                const newStatus = selectElement.value;

                fetch(`/packages/${packageId}/status`, {
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