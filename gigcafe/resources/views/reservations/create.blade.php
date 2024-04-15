@extends('layouts.backend')

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
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
       
    </head>
    @section('content')
<section class="min-vh-100 d-flex align-items-start mt-5 pt-5vh">
    <div class="container">
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('reservations.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Reservation Index</a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                            <div class="mt-1">
                                <input type="text" id="first_name" name="first_name"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('first_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                            <div class="mt-1">
                                <input type="text" id="last_name" name="last_name"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('last_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                            <div class="mt-1">
                                <input type="email" id="email" name="email"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('email')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone number
                            </label>
                            <div class="mt-1">
                                <input type="text" id="tel_number" name="tel_number"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('tel_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date
                            </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="res_date" name="res_date"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('res_date')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                            </label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" name="guest_number"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('guest_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                                <br>
                                    <label for="supply_choice" class="block text-sm font-medium text-gray-700">Supply Choice</label>
                                    <div class="mt-1 flex flex-row">
                                        <input type="radio" id="bring_own" name="supply_choice" value="bring_own" checked class="mr-2">
                                        <label for="bring_own">Bring Own Supplies</label>
                                        <input type="radio" id="borrow_supplies" name="supply_choice" value="borrow_supplies" class="ml-4 mr-2">
                                        <label for="borrow_supplies">Borrow Our Supplies</label>
                                    </div>
                                </div>
                                <br>

                                <!-- Additional input fields for inventory supplies -->
                                <div id="inventoryFields" style="display: none;">
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
                                </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="status" class="block text-sm font-medium text-gray-700">package</label>
                            <div class="mt-1">
                                <select id="package_id" name="package_id" class="form-multiselect block w-full mt-1">
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}
                                            ({{ $package->guest_number }} Guests)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('package_id')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                    @foreach (App\Enums\ReservationStatus::cases() as $status)
                                        <option value="{{ $status->value }}">{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Store</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

@endsection

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