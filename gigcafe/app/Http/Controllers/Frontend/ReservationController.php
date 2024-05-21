<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifReservation;
use Illuminate\Support\Facades\Session;
use App\Enums\PackageStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Package;
use App\Models\Service;
use App\Models\User;
use App\Models\Inventory;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rules\OneReservationPerDay;
use App\Rules\UniqueReservationDate;

class ReservationController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function history()
    {
        $user = auth()->user();
    
        // Check if the user is a customer
        if ($user->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        // Retrieve reservations belonging to the current customer
        $reservations = Reservation::where('email', $user->email)->get();
        
        return view('reservations.history', compact('reservations'));
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
    // Ensure only customers can access this route
    if (auth()->user()->role != 'customer') {
        abort(403, 'This route is only meant for customers.');
    }

    $user = auth()->user(); // Get the authenticated user

    // Validate the request
    $validated = $request->validate([
        'first_name' => ['required'],
        'last_name' => ['required'],
        'res_date' => ['required', 'date', new DateBetween(), new OneReservationPerDay($user->email), new TimeBetween(), new UniqueReservationDate($user->role)],
        'tel_number' => ['required'],
        'guest_number' => ['required', 'integer', 'min:1'],
    ]);

    // Add user's email and ID to the validated data
    $validated['email'] = $user->email;
    $validated['user_id'] = $user->id;
    $validated['role'] = $user->role;

    // Check if reservation session data exists, and store it
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
        'payment_status' => ['required'], // Add validation for the payment method
    ]);

    // Retrieve the reservation from the session
    $reservation = $request->session()->get('reservation');

    // Fill the reservation with validated data
    $reservation->fill($validated);

    // Save the reservation to the database
    $reservation->save();

    // Save inventory supplies and quantities as a single sentence in the reservation
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

    $reservation->inventory_supplies = $inventorySupplies;
    $reservation->save();

    // Forget the reservation from the session
    $request->session()->forget('reservation');

    return redirect()->route('reservations.thankyou');
}

    



    public function thankyou()
{
    $user = auth()->user();
    // Check if the notification flag is set in the session
    if (!Session::has('reservation_notification_sent')) {
        // Check if the user is a customer
        if (auth()->user()->role != 'customer') {
            abort(403, 'This route is only meant for customers.');
        }

        notify()->success('Your reservation has been send to staff for conformation!');
        
        // Send the notification email
        //Mail::send(new NotifReservation());
        
        // Set the notification flag in the session to prevent duplicate notifications
        Session::flash('reservation_notification_sent', true);
    }
    $latestReservation = Reservation::where('email', $user->email)->where('status', '!=', 'Fulfilled')->latest()->first();

    // Pass the latest reservation and payment method to the view
    return view('reservations.thankyou', ['latestReservation' => $latestReservation, 'payment_status' => $latestReservation->payment_status]);

    }
}
