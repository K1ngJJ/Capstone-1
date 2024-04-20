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
    
            // Retrieve the reservation from the session or create a new one
            $reservation = $request->session()->get('reservation', new Reservation());
    
            // Fill the reservation with validated data
            $reservation->fill($request->validated());
    
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
    
            // Store the reservation in the session
            $request->session()->put('reservation', $reservation);
    
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
    
        $inventories = Inventory::all();
        // Retrieve reservations with a specific status
        $reservations = Reservation::where('status', ReservationStatus::Notfulfilled)->get();
    
        // Retrieve available packages
        $packages = Package::where('status', PackageStatus::Available)->get();
    
        return view('reservations.edit', compact('reservation', 'reservations', 'packages', 'inventories'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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
            $reservation->save();
    
            // Update inventory supplies if necessary
            $inventorySupplies = '';
            if ($request->supply_choice == 'bring_own') {
                $inventorySupplies = 'Bring Own Supplies';
            } elseif ($request->supply_choice == 'borrow_supplies') {
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
    
            // Store the updated reservation in the session
            $request->session()->put('reservation', $reservation);
    
            return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Reservation not found.');
        }
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
