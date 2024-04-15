<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PackageStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Package;
use App\Models\Service;
use App\Models\Inventory;
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
        if (auth()->user()->role != 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        $reservation = $request->session()->get('reservation');
    
        // Define $res_package_ids
        $res_package_ids = [];
        if ($reservation && $reservation->packages) {
            $res_package_ids = $reservation->packages->pluck('id')->toArray();
        }
    
        // Fetch inventories data from your database or define it based on your logic
        $inventories = Inventory::all(); // Example query, replace it with your actual logic
    
        // Your existing code for fetching packages and services
        $packages = Package::where('status', PackageStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_package_ids)
            ->get();
    
        $services = Service::all(); // Fetch services
    
        return view('reservations.step-two', compact('reservation', 'packages', 'services', 'inventories'));
    }
    


    public function storeStepTwo(Request $request)
    {
        if (auth()->user()->role != 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        $validated = $request->validate([
            'package_id' => ['required'],
            'service_id' => ['required'],
        ]);
    
        // Retrieve the reservation from the session
        $reservation = $request->session()->get('reservation');
    
        // Fill the reservation with validated data
        $reservation->fill($validated);
    
        // Save the reservation to the database
        $reservation->save();
    
        // Save inventory supplies and quantities as a single sentence in the reservation
        $inventorySupplies = [];
        if ($request->has('inventory_supplies')) {
            foreach ($request->input('inventory_supplies') as $key => $inventoryId) {
                $inventory = Inventory::find($inventoryId);
                $quantity = $request->input('inventory_quantities')[$key];
                $inventorySupplies[] = $inventory->name . ' (' . $quantity . ')';
            }
        }
        $reservation->inventory_supplies = implode(', ', $inventorySupplies);
        $reservation->save();
    
        // Forget the reservation from the session
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
