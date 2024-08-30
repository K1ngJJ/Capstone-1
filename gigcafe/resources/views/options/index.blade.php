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

.gradient-hr {
    border: none; /* Remove default border */
    height: 4px; /* Adjust height as needed */
    background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
    border-radius: 8px;
}

.modal {
    transition: opacity 0.3s ease-in-out;
}

.modal-content {
    transition: transform 0.3s ease-in-out;
}

.modal-header .close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
}

.modal-footer {
    border-top: 1px solid #e5e5e5;
}

/* Modal background with transparency */
.modal {
    transition: opacity 0.3s ease-in-out;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
}

/* Modal content transition */
.modal-content {
    transition: transform 0.3s ease-in-out;
    background-color: #fff; /* White background for the content */
}

/* Modal header close button */
.modal-header .close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
}

/* Modal footer */
.modal-footer {
    border-top: 1px solid #e5e5e5;
}

/* Hidden class to hide the modal */
.hidden {
    display: none;
}

/* Modal opacity and scaling transitions */
.modal.fade.opacity-0 {
    opacity: 0;
}

.modal.fade.opacity-100 {
    opacity: 1;
}

.modal-content.scale-95 {
    transform: scale(0.95);
}

.modal-content.scale-100 {
    transform: scale(1);
}

</style>

<section class="banner">
    <div class="container">
  
<br>
<br>
<br>
    <div class="container w-full px-5 py-6 mx-auto">
    <div class="row my-5 justify-content-between">
    <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h6 class="d-flex justify-content-center menu-title ">OUR SERVICE TYPES</h2>
            <br>
        </div>
    </table>
            <div class="d-flex">
                <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('cservices.index') }}">
                <i class="fa fa-calendar" style="font-size: 17px;"></i>
                    <span>Catering Events</span>
                </a>
                <div class="mt-1 p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                    <!-- Icon for visual emphasis -->
                    <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                    </svg>
                    <!-- Text message -->
                    <span>For more information about our catering services, please check our <a href="{{ route('cservices.index') }}" class="text-blue-500 underline" style="color: #FF8C00;">events</a>.</span>
                </div>
            </div>
            <hr class="my-4 gradient-hr">
        <div class="grid lg:grid-cols-4 gap-y-6">
        @foreach ($cateringoptions as $cateringoption)
<div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
    <img class="w-full h-48" src="{{ Storage::url($cateringoption->image) }}" alt="Image" />
    <div class="px-6 py-4">
        <div class="flex flex-col items-center justify-center w-full">
            <h4 class="mb-3 text-xl font-semibold tracking-tight text-black-600 hover:text-black-400 uppercase">
                {{ $cateringoption->name }}
            </h4>
            <div class="flex items-center justify-between w-full px-4">
                <button data-modal-target="modal-{{ $loop->index }}" class="bg-custom-color hover:bg-black-600 text-custom font-bold py-2 px-2 rounded">
                    More Details
                </button>
                <div class="flex-grow"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-{{ $loop->index }}" class="modal fade fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center transition-opacity duration-300 ease-in-out opacity-0" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $loop->index }}Label" aria-hidden="true">
    <div class="modal-dialog relative max-w-lg mx-auto" role="document">
        <div class="modal-content bg-white rounded-lg shadow-lg transition-transform transform scale-95 duration-300 ease-in-out">
            <div class="modal-header flex items-center justify-between p-4 border-b">
                <h5 class="modal-title text-xl font-semibold" id="modal-{{ $loop->index }}Label">{{ $cateringoption->name }}</h5>
                <button class="close" data-modal-close="modal-{{ $loop->index }}" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body p-4">
                <img class="w-full h-48 mb-4" src="{{ Storage::url($cateringoption->image) }}" alt="Image" />
                <p class="text-gray-700">{{ $cateringoption->description }}</p>
            </div>
            <div class="modal-footer p-4 border-t text-right">
                <button class="bg-red-600 text-white py-2 px-4 rounded" data-modal-close="modal-{{ $loop->index }}">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach


        </div>
    </div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const openButtons = document.querySelectorAll('[data-modal-target]');
    const closeButtons = document.querySelectorAll('[data-modal-close]');

    openButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                modal.querySelector('.modal-content').classList.remove('scale-95');
                modal.querySelector('.modal-content').classList.add('scale-100');
            }, 10);
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-close');
            const modal = document.getElementById(modalId);
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            modal.querySelector('.modal-content').classList.remove('scale-100');
            modal.querySelector('.modal-content').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });
    });

    // Optional: Close modal when clicking outside of it
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-dialog')) {
            event.target.classList.remove('opacity-100');
            event.target.classList.add('opacity-0');
            event.target.querySelector('.modal-content').classList.remove('scale-100');
            event.target.querySelector('.modal-content').classList.add('scale-95');
            setTimeout(() => {
                event.target.classList.add('hidden');
            }, 300);
        }
    });
});
</script>

</section>
</html>
@endsection
