<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Enums\PackageStatus;
use App\Enums\ReservationStatus;
use App\Models\Package;
use App\Models\Service;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifReservation;
use App\Models\User;

class ReservationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }

        $services = Service::all();
        $packages = Package::all();
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations', 'services', 'packages'));
    }

    public function create()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }

        $services = Service::all();
        $inventories = Inventory::all();
        $packages = Package::where('status', PackageStatus::Available)->get();
        return view('reservations.create', compact('packages', 'inventories', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }

        try {
            $package = Package::findOrFail($request->package_id);
    
            if ($request->guest_number > $package->guest_number) {
                return back()->with('warning', 'Please choose the package based on the number of guests.');
            }
    
            $request_date = Carbon::parse($request->res_date);
    
            // Check if reservations exist for the package
            if ($package->reservations !== null) {
                foreach ($package->reservations as $res) {
                    $reservationDate = Carbon::parse($res->res_date);
    
                    if ($reservationDate->isSameDay($request_date)) {
                        return back()->with('warning', 'This package is reserved for the selected date.');
                    }
                }
            }
    
            // Create and fill the reservation with validated data
            $reservation = new Reservation();
            $reservation->fill($request->validated());
    
            // Set the status to Pending by default
            $reservation->status = ReservationStatus::Pending;
    
            // Save the reservation to the database
            $reservation->save();
    
            // Determine inventory supplies based on the selected supply choice
            $inventorySupplies = '';
            if ($request->supply_choice == 'bring_own') {
                $inventorySupplies = 'Bring Own Supplies';
            } elseif ($request->supply_choice == 'borrow_supplies') {
                // Save inventory supplies and quantities as a single sentence in the reservation
                $inventorySuppliesArray = [];
                if ($request->has('inventory_supplies')) {
                    foreach ($request->input('inventory_supplies') as $key => $inventoryId) {
                        $inventory = Inventory::find($inventoryId);
                        $quantity = $request->input('inventory_quantities')[$key];
                        $inventorySuppliesArray[] = $inventory->name . ' (' . $quantity . ')';
                    }
                }
                $inventorySupplies = implode(', ', $inventorySuppliesArray);
            }
    
            // Update the reservation's inventory supplies
            $reservation->inventory_supplies = $inventorySupplies;
            $reservation->save();
    
            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Package not found.');
        }
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $reservation = Reservation::with(['service', 'package'])->findOrFail($id);
    return response()->json($reservation);
}


    /**
     * Show the form for editing the specified resource.
     */
    // ReservationController.php
    public function edit($id)
    {
        $reservation = Reservation::with('inventory_supplies')->findOrFail($id);
        $services = Service::all();
        $packages = Package::all();
        $inventories = Inventory::all();

        return view('reservations.edit', compact('reservation', 'services', 'packages', 'inventories'));
    }

    /**
     * Update the specified resource in storage.
     * */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
    
        try {
            $reservation = Reservation::findOrFail($id);
            
            // Check if the package is being updated
            if ($request->has('package_id')) {
                $package = Package::findOrFail($request->package_id);
                if ($request->guest_number > $package->guest_number) {
                    return back()->with('warning', 'Please choose the package based on the number of guests.');
                }
    
                $request_date = Carbon::parse($request->res_date);
                
                // Check if reservations exist for the package on the same date
                if ($package->reservations()->whereDate('res_date', $request_date)->exists()) {
                    return back()->with('warning', 'This package is reserved for the selected date.');
                }
                
                $reservation->package_id = $package->id;
            }
            
            // Update other reservation fields
            $reservation->fill($request->except(['package_id']));
            
            // Update inventory supplies if necessary
            $inventorySupplies = $this->handleInventorySupplies($request);
            $reservation->inventory_supplies = $inventorySupplies;
            
             // Update reservation status if provided
             if ($request->has('status')) {
                $status = $request->input('status');
                if (in_array($status, ReservationStatus::cases())) {
                    $reservation->status = ReservationStatus::from($status);
                }
            }
    
            // Save the reservation
            $reservation->save();
            
           // Send the notification email if the status is Declined, Approved, or Fulfilled
            if ($reservation->status === 'Declined' || $reservation->status === 'Approved' || $reservation->status === 'Fulfilled') {
                Mail::to($reservation->email)->send(new NotifReservation($reservation->status));
            }

            // Store the updated reservation in the session
            $request->session()->put('reservation', $reservation);
    
    
            return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Reservation not found.');
        }
    }
    

private function handleInventorySupplies($request)
{
    if ($request->supply_choice == 'bring_own') {
        return 'Bring Own Supplies';
    } elseif ($request->supply_choice == 'borrow_supplies') {
        $inventorySuppliesArray = [];
        if ($request->has('inventory_supplies')) {
            foreach ($request->input('inventory_supplies') as $key => $inventoryId) {
                $inventory = Inventory::find($inventoryId);
                $quantity = $request->input('inventory_quantities')[$key];
                $inventorySuppliesArray[] = $inventory->name . ' (' . $quantity . ')';
            }
        }
        return implode(', ', $inventorySuppliesArray);
    }
    return '';
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
        
        $reservation->delete();

        return redirect()->route('reservations.index')->with('warning', 'Reservation deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
{
    if (auth()->user()->role == 'customer') {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    try {
        $reservation = Reservation::findOrFail($id);
        $status = $request->input('status');

        // Check if the provided status is valid
        if (in_array($status, array_column(ReservationStatus::cases(), 'value'))) {
            $reservation->status = $status;
            $reservation->save();

            // Optionally send an email notification if required
            if (in_array($reservation->status, ['Declined', 'Approved', 'Fulfilled', 'Cancelled', 'Pending'])) {
                Mail::to($reservation->email)->send(new NotifReservation($reservation->status));
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Invalid status'], 400);
        }
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Reservation not found'], 404);
    }
}

public function filterReservation(Request $request)
{
    $query = Reservation::query();

    // Filter by ID
    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    // Filter by date range
    if ($request->filled('startDate') && $request->filled('endDate')) {
        $query->whereBetween('res_date', [$request->startDate, $request->endDate]);
    }

    // Filter by time range
    if ($request->filled('startTime') && $request->filled('endTime')) {
        $query->whereTime('res_date', '>=', $request->startTime)
              ->whereTime('res_date', '<=', $request->endTime);
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by payment_status
    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    // Filter by service
    if ($request->filled('service')) {
        $query->whereHas('service', function($q) use ($request) {
            $q->where('name', $request->service);
        });
    }

    // Filter by package
    if ($request->filled('package')) {
        $query->whereHas('package', function($q) use ($request) {
            $q->where('name', $request->package);
        });
    }

    $reservations = $query->get();

    // Fetch services and packages for the filter form
    $services = Service::all();
    $packages = Package::all();

    return view('reservations.index', compact('reservations', 'services', 'packages'));
}

}
