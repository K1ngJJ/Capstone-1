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
use App\Models\Inventory;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
       
        
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
       
        $inventories = Inventory::all();
        $packages = Package::where('status', PackageStatus::Available)->get();
        return view('reservations.create', compact('packages', 'inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
       
        
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
    
            Reservation::create($request->validated());
    
            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Package not found.');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        // Retrieve reservations with a specific status
        $reservations = Reservation::where('status', ReservationStatus::Notfulfilled)->get();
    
        // Retrieve available packages
        $packages = Package::where('status', PackageStatus::Available)->get();
    
        return view('reservations.edit', compact('reservation', 'reservations', 'packages'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
{
    $package = Package::findOrFail($request->package_id);

    if ($request->guest_number > $package->guest_number) {
        return back()->with('warning', 'Please choose the package based on the number of guests.');
    }

    $request_date = Carbon::parse($request->res_date);

    // Check if reservations exist for the package
    if ($package->reservations !== null) {
        foreach ($package->reservations as $res) {
            $reservationDate = Carbon::parse($res->res_date);

            if ($reservationDate->isSameDay($request_date) && $res->id !== $reservation->id) {
                return back()->with('warning', 'This package is reserved for this date.');
            }
        }
    }

    // Update reservation including the 'status'
    $reservation->update(array_merge($request->validated(), ['status' => $request->status]));

    return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        
        $reservation->delete();

        return redirect()->route('reservations.index')->with('warning', 'Reservation deleted successfully.');
    }
}
