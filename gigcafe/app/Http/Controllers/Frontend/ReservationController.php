<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PackageStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Package;
use App\Models\Service;
//use App\Rules\DateBetween;
//use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function stepOne(Request $request)
    {
        if (auth()->user()->role != 'customer')
        abort(403, 'This route is only meant for customers.');

        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request)
    {
        if (auth()->user()->role != 'customer')
        abort(403, 'This route is only meant for customers.');

        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date'],
            'tel_number' => ['required'],
            'guest_number' => ['required'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }

        return redirect()->route('reservations.step.two');
    }
    public function stepTwo(Request $request)
    {
        if (auth()->user()->role != 'customer')
        abort(403, 'This route is only meant for customers.');

        $reservation = $request->session()->get('reservation');
    
        // Ensure $reservation->res_date is a DateTime object before calling format
        $reservationDate = $reservation->res_date instanceof \DateTime
            ? $reservation->res_date
            : new \DateTime($reservation->res_date);
    
        $res_package_ids = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservationDate) {
            // Ensure $value->res_date is a DateTime object before calling format
            $valueDate = $value->res_date instanceof \DateTime
                ? $value->res_date
                : new \DateTime($value->res_date);
    
            return $valueDate->format('Y-m-d') == $reservationDate->format('Y-m-d');
        })->pluck('package_id');
    
        $packages = Package::where('status', PackageStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_package_ids)
            ->get();
    
        $services = Service::all(); // Fetch services
    
        return view('reservations.step-two', compact('reservation', 'packages', 'services'));
    }
    


public function storeStepTwo(Request $request)
{
    if (auth()->user()->role != 'customer')
    abort(403, 'This route is only meant for customers.');

    $validated = $request->validate([
        'package_id' => ['required'],
        'service_id' => ['required'],
    ]);
    $reservation = $request->session()->get('reservation');
    $reservation->fill($validated);
    $reservation->save();
    $request->session()->forget('reservation');

    return redirect()->route('reservations.thankyou');
}



    public function thankyou()
    {
        if (auth()->user()->role != 'customer')
        abort(403, 'This route is only meant for customers.');
    
        return view('reservations.thankyou');
    }
}
