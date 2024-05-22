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
            <h6 class="d-flex justify-content-center menu-title">CATERING SERVICES</h2>
            <hr class="my-4">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($services as $service)
            <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
            <a href="{{ route('cservices.show', $service->id) }}">
                <img class="w-full h-48" src="{{ Storage::url($service->image) }}" alt="Image" />
            </a>
                <div class="px-6 py-4">
                    <a href="{{ route('cservices.show', $service->id) }}" class="flex items-center justify-between">
                    <div class="flex flex-col items-center justify-center w-full">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-black-600 hover:text-black-400 uppercase">
                            {{ $service->name }}
                        </h4>
                        <div class="flex items-center justify-between w-full px-4">
                            <a href="{{ route('reservations.step.one') }}" class="bg-custom-color hover:bg-black-600 text-custom font-bold py-2 px-2 rounded">
                                Book Now
                            </a>
                            <div class="flex-grow"></div>
                            <div class="flex items-center text-xl font-bold">
                                <span class="text-yellow-500 text-2xl font-bold">★</span> <!-- Star icon -->
                                @php
                                    $averageRating = isset($serviceRatings[$service->id]) ? number_format($serviceRatings[$service->id], 1) : '0.0';
                                @endphp
                                {{ $averageRating }}
                            </div>
                        </div>
                    </div>

                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
</div>
</section>
</html>
@endsection
