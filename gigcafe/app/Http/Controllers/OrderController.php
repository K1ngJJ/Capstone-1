<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function index() { // Cust regular order page
        $activeOrder = auth()->user()->orders()->where('completed', 0)->orderBy('dateTime', 'desc')->first();
        $allOrders = auth()->user()->orders()->orderBy('dateTime', 'desc')->paginate(8);
        return view('order', compact('activeOrder', 'allOrders'));
    }

    public function show(Order $order) { // Customer specific order page
        $activeOrder = $order;
        $allOrders = auth()->user()->orders()->orderBy('dateTime', 'desc')->paginate(8);
        return view('order', compact('activeOrder', 'allOrders'));
    }

    public function kitchenOrder() { // Kitchen or Admin's order page
        if (auth()->user()->role == 'customer')
            abort(403, 'This route is only meant for restaurant staffs.');

        $activeOrders = Order::where('completed', 0)->orderBy('dateTime', 'desc')->paginate(8);
        $firstOrder = $activeOrders->first();
        return view('kitchenOrder', compact('firstOrder', 'activeOrders'));
    }

    public function specificKitchenOrder(Order $order) { // Kitchen or Admin's specific order page
        if (auth()->user()->role == 'customer')
            abort(403, 'This route is only meant for restaurant staffs.');

        $activeOrders = Order::where('completed', 0)->orderBy('dateTime', 'desc')->paginate(8);
        $firstOrder = $order;
        $transactions = Transaction::with('order.user', 'order.cartItems.menu')->get();
        return view('kitchenOrder', compact('firstOrder', 'activeOrders', 'transactions'));
    }

    public function orderStatusUpdate(CartItem $orderItem) { // Kitchen or Admin update order status
        if (auth()->user()->role == 'customer')
            abort(403, 'This route is only meant for restaurant staffs.');

        $orderItem->fulfilled = $orderItem->fulfilled ? false : true;
        $orderItem->save();

        $cartItems = CartItem::where('order_id', $orderItem->order_id)->paginate(8);
        foreach ($cartItems as $item) {
            if (!$item->fulfilled)
                return redirect()->route('kitchenOrder');
        }
        $orderItem->order->completed = true;
        $orderItem->push();
        return redirect()->route('kitchenOrder');
    }

    public function previousOrder() { // Kitchen or Admin view all previous orders
        if (auth()->user()->role == 'customer')
            abort(403, 'This route is only meant for restaurant staffs.');

        // this is actually 'previousOrders' not 'activeOrders', but i name it this way 
        // just for the blade's variable naming sake
        $previousOrders = Order::where('completed', 1)->orderBy('dateTime', 'desc')->paginate(8);
        $transactions = Transaction::with('order.user', 'order.cartItems.menu')->get();
        return view('previousOrder', compact('previousOrders', 'transactions'));
    }
    

    public function filterPreviousOrders(Request $request) {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
    
        $query = Order::where('completed', 1);
    
        // Filter by Order ID
        if ($request->filled('orderID')) {
            $query->where('id', $request->orderID);
        }
    
        // Filter by Order Date
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $query->whereBetween('dateTime', [$startDate, $endDate]);
        }
    
        // Filter by Order Time
        if ($request->filled('startTime') && $request->filled('endTime')) {
            $startTime = Carbon::parse($request->startTime)->format('H:i:s');
            $endTime = Carbon::parse($request->endTime)->format('H:i:s');
            $query->whereTime('dateTime', '>=', $startTime)
                  ->whereTime('dateTime', '<=', $endTime);
        }
    
        // Filter by Order Type (Dine In or Take Out)
        if ($request->filled('orderType')) {
            $query->where('type', $request->orderType);
        }
    
        // Determine sort field and order
        $sortField = $request->filled('sortField') ? $request->sortField : 'dateTime';
        $sortOrder = $request->filled('sortOrder') && $request->sortOrder == 'asc' ? 'asc' : 'desc';
    
        // Apply sorting based on the sort field
        $query->orderBy($sortField, $sortOrder);
    
        // Paginate the results
        $previousOrders = $query->paginate(8);
    
        // Eager load related transactions
        $transactions = Transaction::with('order.user', 'order.cartItems.menu')->get();
    
        // Return the view with filtered and sorted orders
        return view('previousOrder', compact('previousOrders', 'transactions'));
    }
    


    
    
    
}
