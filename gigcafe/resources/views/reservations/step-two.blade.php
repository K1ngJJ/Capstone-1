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
       
    </head>

@section('content')

<style>
.menu-title{
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

</style>

<section class="banner">
    <div class="container">
  
<br>
<br>
<br>
<br>
<br>


    <div class="container w-full px-5 py-6 mx-auto">
        <h6 class="d-flex justify-content-center menu-title">CATERING RESERVATION</h2>
            <hr class="my-4">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="flex">
                        <div class="h-32 md:h-auto md:w-1/2">
                            <img class="object-cover w-full h-full" src="{{ asset('images/Restaurant.jpeg') }}" alt="img" />
                        </div>
              
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-gradient-to-r from-green-400 to-blue-500 hover:bg-green-400 rounded-full">
                                    Step2</div>
                            </div>

                            <form method="POST" action="{{ route('reservations.store.step.two') }}">
                                @csrf

                                <div class="sm:col-span-6 pt-5">
                                    <label for="service_id" class="block text-sm font-medium text-gray-700">Services</label>
                                    <div class="mt-1">
                                        <select id="service_id" name="service_id" class="form-multiselect block w-full mt-1">
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" {{ $service->id == $reservation->service_id ? 'selected' : '' }}>
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('service_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 pt-5">
                                    <label for="package_id" class="block text-sm font-medium text-gray-700">Packages</label>
                                    <div class="mt-1">
                                        <select id="package_id" name="package_id" class="form-multiselect block w-full mt-1">
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}" {{ $package->id == $reservation->package_id ? 'selected' : '' }}>
                                                    {{ $package->name }} ({{ $package->guest_number }} Guests)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('package_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                                

                                <div class="mt-6 p-4 flex justify-between">
                                    <a href="{{ route('reservations.step.one') }}"
                                        class="px-4 py-2 rounded-lg bg-custom-color">Previous</a>
                                    <button type="submit"
                                        class="px-4 py-2 rounded-lg bg-custom-color">Make
                                        Reservation</button>
                                        <style>
                                            .bg-custom-color { 
                                                margin-right: 250px;
                                                color: white;
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
                                        </style>
                                </div>
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

