@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'previousOrder' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

@section('content')

<section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container mt-lg-0 mt-5">
            <h2 class="mt-5 mb-4">Catering Reservations</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tel No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Service</th>
                        <th scope="col">Package</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Supply</th>
                        <th scope="col">Status</th>
                        <th scope="col">
                        <a class="btn btn-dark btn-sm" href="{{ route('ReservationsTxn.Pdf') }}" download><i class="fa fa-download"></i><a>
                            <a href="{{ route('reservations.create') }}" class="primary-btn"><i class="fa fa-plus mr-2"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <th scope="row">#{{ $reservation->id }}</th>
                        <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                        <td>{{ $reservation->email }}</td>
                        <td>{{ $reservation->tel_number }}</td>  
                        <td class="email">{{ $reservation->res_date }}</td>
                        <td>{{ $reservation->service ? $reservation->service->name : 'No service associated' }}</td>
                        <td>{{ $reservation->package ? $reservation->package->name : 'No package associated' }}</td>
                        <td>{{ $reservation->guest_number }}</td>
                        <td class="email">{{ $reservation->inventory_supplies }}</td>
                        <td class="@if($reservation->status == 'Fulfilled') px-3 alert alert-success @else px-1 alert alert-warning @endif">
                            {{ $reservation->status }}
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                @if($reservation->status !== 'Fulfilled')
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="px-3 py-1 bg-green-500 hover:bg-green-700 rounded-lg text-white text-sm">Edit</a>
                                @endif
                                <form class="px-1.4 py-1 bg-red-500 hover:bg-red-700 rounded-lg text-white text-sm" method="POST" action="{{ route('reservations.destroy', $reservation->id) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
