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
        <h2 class="d-flex justify-content-center menu-title">PENDING RESERVATION</h2>
            <hr class="my-4">
        <div class="flex items-center bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="flex">
              
                        <div class="container mx-auto max-w-screen-xl">
                        <div class="flex items-center justify-center p-6">
                            <div class="w-full">
                                <div class="w-full bg-gray-200 rounded-full">
                                    <div class="w-40 p-1 text-xs font-medium leading-none text-center rounded-full">
                                        Reservation Form Complete!
                                    </div>
                                </div>
                                <br>

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
</html>
@endsection
