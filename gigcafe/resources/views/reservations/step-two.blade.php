@extends('layouts.app')

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <!-- Button styling -->
    <style>
        .button-container a,
        .button-container button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container a {
            background-color: #CE3232;
            color: white;
        }

        .button-container a:hover {
            background-color: #dfe1e2;
            color: black;
            transition-duration: 0.8s;
        }

        .button-container button {
            background-color: #CE3232;
            color: white;
        }

        .button-container button:hover {
            background-color: #dfe1e2;
            color: black;
            transition-duration: 0.8s;

            
        }

        .bold-divider {
            font-weight: bold; /* Make text bold */
            height: 2px; /* Increase height to make the line bolder */
            background-color: darkorange; /* Ensure the line is visible */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;

        }
    </style>
</head>

@section('content')

<style>
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

.gradient-hr {
    border: none; /* Remove default border */
    height: 4px; /* Adjust height as needed */
    background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
    border-radius: 8px;
}

.border-gradient {
    border-image: linear-gradient(to right, black, #FF8C00, #dc3545)1;
}

</style>

<section class="banner">
    <div class="container">
  
<br>
<br>
<br>
<br>
<br>


    <div class="container w-full px-5 py-6 mx-auto">
    <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h2 class="d-flex justify-content-center menu-title">MAKE RESERVATION</h2>
            <br>
        </div>
    </table>
    <hr class="my-4 gradient-hr">
        <div class="flex items-center bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="flex">
              
                    <div class="container mx-auto max-w-screen-xl">
                    <div class="flex items-center justify-center p-6">
                        <div class="w-full">
                        <div class="w-full bg-gray-100 rounded-full border-1 border-transparent border-gradient">
                                <div class="w-40 p-1 text-xs font-medium leading-none text-center rounded-full">
                                    Step 2
                                </div>
                            </div>
                            <br>

                            <form method="POST" action="{{ route('reservations.store.step.two') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                <label for="service_id" class="py-1 px-2 text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">For what event?</label>
                                    <div class="mt-1">
                                        <select id="service_id" name="service_id" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="" disabled selected>Select Event</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" {{ $service->id == $reservation->service_id ? 'selected' : '' }}>
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                            <option value="">Other</option>
                                        </select>
                                    </div>
                                    @error('service_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!--div class="dropdown-divider bold-divider gradient-hr"></div-->
                                <hr class="my-2 gradient-hr">

                                <div class="sm:col-span-6 pt-10">
                                <label for="cateringoption_id" class="py-1 px-2 text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Catering Options</label>
                                    <div class="mt-1">
                                        <select id="cateringoption_id" name="cateringoption_id" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="" disabled selected>Select Types</option>
                                            @foreach ($cateringoptions as $cateringoption)
                                                <option value="{{ $cateringoption->id }}" {{ $cateringoption->id == $reservation->cateringoption_id ? 'selected' : '' }}>
                                                    {{ $cateringoption->name }}
                                                </option>
                                            @endforeach
                                            <option value="">Other</option>
                                        </select>
                                    </div>
                                    @error('cateringoption_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-2 p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs">If there are no packages it may mean that there are no packages that can fit your guest count.</span>
                                </div>
                                
                                <!--div class="dropdown-divider bold-divider gradient-hr"></div-->
                                <hr class="my-1 gradient-hr">

                                <div class="sm:col-span-6 pt-10">
                                <label for="package_id" class="py-1 px-2 text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Packages</label>
                                    <div class="mt-1">
                                        <select id="package_id" name="package_id" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="" disabled selected>Select Package</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}" {{ $package->id == $reservation->package_id ? 'selected' : '' }}>
                                                    {{ $package->name }} ({{ $package->guest_number }} Guests)
                                                </option>
                                            @endforeach
                                            <option value="">Other</option>
                                        </select>
                                    </div>
                                    @error('package_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-2 p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs">If there are no packages it may mean that there are no packages that can fit your guest count.</span>
                                </div>
                                
                                <!--div class="dropdown-divider bold-divider gradient-hr"></div-->
                                <hr class="my-1 gradient-hr">

                                <div class="col-12 mb-3">
                                    <label for="payment_status" class="block py-1 px-2 text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Payment Mode
                                    </label>
                                    <select name="payment_status" id="payment_status" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="" disabled selected>Select Payment Mode</option>
                                        <option value="Fully Payment">Full Payment</option>
                                        <option value="Down Payment">Down Payment</option>
                                        <option value="Pay in Restaurant">Pay in Restaurant</option>
                                    </select>
                                </div>
                                @error('payment_status')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                <!--div class="dropdown-divider bold-divider"></div>
                                <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
                                <div class="sm:col-span-6">
                                <br>
                                    <label for="supply_choice" class="block text-sm font-medium text-gray-700">Supply Choice</label>
                                    <div class="mt-1 flex flex-row">
                                        <input type="radio" id="bring_own" name="supply_choice" value="bring_own" checked class="mr-2">
                                        <label for="bring_own">Bring Own Supplies</label>
                                        <input type="radio" id="borrow_supplies" name="supply_choice" value="borrow_supplies" class="ml-4 mr-2">
                                        <label for="borrow_supplies">Borrow Our Supplies</label>
                                    </div>
                                </div-->

                                <!-- Additional input fields for inventory supplies -->
                                <!--div id="inventoryFields" style="display: none;">
                                <div class="sm:col-span-6">
                                    <label for="inventory_supplies" class="block text-sm font-medium text-gray-700">Inventory Supplies</label>
                                    @foreach ($inventories as $inventory)
                                        <div class="flex items-center mb-2">
                                            <input type="checkbox" id="inventory_{{ $inventory->id }}" name="inventory_supplies[]" value="{{ $inventory->id }}" class="mr-2">
                                            <label for="inventory_{{ $inventory->id }}"> {{ $inventory->name }}</label>
                                            <input type="number" id="quantity_{{ $inventory->id }}" name="inventory_quantities[]" value="1" class="ml-4 w-8 border border-gray-400 rounded-md py-1 px-2">
                                        </div>
                                    @endforeach
                                </div>
                                </div-->
                                <div class="my-2 dropdown-divider bold-divider gradient-hr"></div>
                                <br>

                                <div class="d-flex flex-wrap align-items-center gap-4">
                                    <!-- Previous Button -->
                                    <a href="{{ route('reservations.step.one') }}" class="px-4 py-2 btn btn-custom-color primary-btn flex-shrink-0">Previous</a>
                                    
                                    <!-- Note Message -->
                                    <div class="flex items-center p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex-grow min-w-0">
                                        <!-- Icon for visual emphasis -->
                                        <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                        </svg>
                                        <!-- Text message -->
                                        <span class="text-xs sm:text-sm md:text-base">
                                            For more information about our catering options, please check our 
                                            <a href="{{ route('options.index') }}" class="text-blue-500 underline" style="color: #FF8C00;">service types</a>.
                                        </span>
                                    </div>
                                    
                                    <!-- Next Button -->
                                    <button type="submit" class="px-4 py-2 btn btn-custom-color primary-btn flex-shrink-0">Make Reservation</button>
                                </div>
                                </div>
                                </div>
                                <!--div class="button-container mt-2 p-4 flex justify-between">
                                    <a href="{{ route('reservations.step.one') }}" class="px-4 py-2 btn btn-custom-color">Previous</a>
                                    <button type="submit" class="px-4 py-2 btn btn-custom-color">Make Reservation</button>
                                </div-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>
</div>
</section>
</html>
@endsection

<!-- JavaScript to toggle visibility of additional input fields -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get radio buttons and additional input fields
        const bringOwnRadio = document.getElementById('bring_own');
        const borrowSuppliesRadio = document.getElementById('borrow_supplies');
        const inventoryFields = document.getElementById('inventoryFields');

        // Function to toggle additional input fields visibility
        function toggleInventoryFields() {
            inventoryFields.style.display = borrowSuppliesRadio.checked ? 'block' : 'none';
        }

        // Initial toggle based on checked status
        toggleInventoryFields();

        // Add event listeners to radio buttons
        bringOwnRadio.addEventListener('change', function () {
            toggleInventoryFields();
        });

        borrowSuppliesRadio.addEventListener('change', function () {
            toggleInventoryFields();
        });
    });
</script>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var serviceDropdown = document.getElementById('cateringoption_id');
        var serviceDropdown = document.getElementById('service_id');
        var packageDropdown = document.getElementById('package_id');
        var packageError = document.getElementById('package-error');

        serviceDropdown.addEventListener('change', function () {
            var serviceId = this.value;

            // Clear previous options
            packageDropdown.innerHTML = '';

            // Fetch available packages for the selected service
            fetch('/fetch-packages/' + serviceId)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        packageError.textContent = data.error;
                    } else {
                        // Populate packages dropdown with fetched data
                        data.packages.forEach(function (package) {
                            var option = document.createElement('option');
                            option.value = package.id;
                            option.text = package.name + ' (' + package.guest_number + ' Guests)';
                            packageDropdown.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    packageError.textContent = 'Error fetching data.';
                });
        });
    });
</script>
@endpush
