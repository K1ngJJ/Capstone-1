@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/accountCreation.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'accountCreation' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<section class="container mt-5 mt-md-0 pt-5 pt-md-0">
<div class="row d-flex justify-content-center" id="top-bar">
        <div class="col-md-2" id="title">
            <label>Manage Accounts</label>
        </div>
    </div>


    <div class="container">
        <h2 class="mb-4">Accounts</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
               

      
                <tr class="table-active">
                @foreach ($users as $user)
                <tr>
           
                @if($user)
                    <th scope="row">{{ $user->id }}</th>
                @endif

                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->contactnum}}</td>
                    <td>
                    <a href="{{ route('user.update', ['id' => $user->id]) }}" class="primary-btn btn-{{ $user->status ? 'success' : 'danger' }}">
                        {{ $user->status ? 'Enable' : 'Disable' }}
                    </a>
                    </td>
                    <td>
                        <a href="" class="primary-btn">Edit</a>
                        <a href="" class="primary-btn">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row mt-md-4">
            <div class="col-12 flex-center">
                
            </div>
        </div>
    </div>


</section>
@endsection