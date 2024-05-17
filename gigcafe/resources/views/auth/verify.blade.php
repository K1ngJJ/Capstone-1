@extends('layouts.auth')

@section('links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'register' }}@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ '../images/White Logo.png' }}@endsection


@section('content')
    <div class="flex items-center">
        <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="flex flex-col md:flex-row">
                <div class="flex">
                    <div class="container mx-auto max-w-screen-xl">
                        <div class="flex items-center justify-center p-6">
                            <div class="w-full">
    <x-auth-card>
    <h2 class="d-flex justify-content-center menu-title">VERIFY YOUR ACCOUNT!</h2>
            <hr class="my-4">
        <x-slot name="logo">
            <a href="/">
                <!--x-application-logo class="w-20 h-20 fill-current text-gray-500" /-->
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </x-auth-card>
    @endsection
