<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (auth()->user()->role != 'admin')
            abort(403, 'This route is only meant for admin.');

        $notifications = auth()->user()->unreadNotifications;

        // General variables useful for all charts / graphs
        $lastMonthDate = Carbon::now()->subDays(30)->toDateTimeString();
        $today = Carbon::today()->toDateString();
        $oneMonthTransactions = Transaction::where('created_at', '>=', $lastMonthDate)->get();
        
        // ================   Calculate Revenue   ========================
        $totalRevenue = $oneMonthTransactions->sum("final_amount");
        // $dailyRevenue will store date-revenue pair for the past 30 days
        $dailyRevenue = Transaction::select(
            DB::raw('date(created_at) as date'), DB::raw('SUM(final_amount) as revenue'))
            ->where('created_at', '>=', $lastMonthDate)
            ->groupBy('date')->orderBy('date')->get();
        // =============   End of Calculate Revenue   =====================

        // ================   Calculate Estimated Cost   =====================
        $totalCost = 0;
        foreach ($oneMonthTransactions as $transaction) {
            $totalCost += $transaction->order->getTotalCost();
        }
        // ===============   End of Calculate Estimated Cost   ===============

        // ================   Calculate Gross Profit   =====================
        $grossProfit = $totalRevenue - $totalCost;
        // ================   End of Calculate Gross Profit   =====================

        // ================   Total Orders   =====================
        $totalOrders = $oneMonthTransactions->count();
        $dailyOrders = Order::select(
            DB::raw('date(dateTime) as date'), DB::raw('COUNT(*) as orders'))
            ->where('created_at', '>=', $lastMonthDate)
            ->groupBy('date')->orderBy('date')->get();
        // =============   End of Total Orders   =====================

        // ================   Product Category   =====================
        $categoricalSales = [0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($oneMonthTransactions as $transaction) {
            $cartItems = $transaction->order->cartItems;

            foreach ($cartItems as $item) {
                $itemType = $item->menu->type;
                $itemPrice = $item->menu->price;
                $itemQty = $item->quantity;

                switch($itemType) {
                    case "Silog":
                        $categoricalSales[0] += $itemPrice * $itemQty;
                    case "Sandwich":
                        $categoricalSales[1] += $itemPrice * $itemQty;
                    case "Burger":
                        $categoricalSales[2] += $itemPrice * $itemQty;
                    case "Pasta":
                        $categoricalSales[3] += $itemPrice * $itemQty;
                    case "Snacks":
                        $categoricalSales[4] += $itemPrice * $itemQty;
                    case "MilkTea":
                        $categoricalSales[5] += $itemPrice * $itemQty;
                    case "FruitTea":
                        $categoricalSales[6] += $itemPrice * $itemQty;
                    case "Etc.":
                        $categoricalSales[6] += $itemPrice * $itemQty;
                }
            }
        }
        for ($i=0; $i < count($categoricalSales) ; $i++) {
            $categoricalSales[$i] = number_format((float)$categoricalSales[$i], 2, '.', '');
        }
        // =============   End of Product Category   =====================

        // =============   Best Selling Product   =====================
        $productSales = array();
        foreach ($oneMonthTransactions as $transaction) {
            $cartItems = $transaction->order->cartItems;

            foreach ($cartItems as $item) {
                $itemName = $item->menu->name;
                $itemQty = $item->quantity;
                if (isset($productSales[$itemName])) {
                    $productSales[$itemName] = $productSales[$itemName] + $itemQty;
                } else {
                    $productSales[$itemName] = $itemQty;
                }
            }
        }
        arsort($productSales);
        $finalProductSales = array();
        foreach ($productSales as $product => $sale_count) {
            $temp = array();
            $temp['x'] = $product;
            $temp['y'] = $sale_count;
            array_push($finalProductSales, $temp);
        }
        // =============   End of Best Selling Product   =====================


        // Ensure the arrays are complete even when there is no order for that day
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod(new DateTime($lastMonthDate), $interval, new DateTime($today));  
        
        foreach ($period as $date) {
            $date = $date->format('Y-m-d');
            if (!$dailyRevenue->contains('date', $date))
                $dailyRevenue->push(array('date' => $date, 'revenue' => 0));
            if (!$dailyOrders->contains('date', $date))
                $dailyOrders->push(array('date' => $date, 'orders' => 0));
        }

        // Sort arrays by date
        $dailyRevenue = $dailyRevenue->toArray();
        $dailyOrders = $dailyOrders->toArray();
        $dates = array_column($dailyRevenue, 'date');
        array_multisort($dates, $dailyRevenue);
        $dates = array_column($dailyOrders, 'date');
        array_multisort($dates, $dailyOrders);
        $dailyRevenue = json_encode($dailyRevenue);
        $dailyOrders = json_encode($dailyOrders);
        $categoricalSales = json_encode($categoricalSales);
        $finalProductSales = json_encode($finalProductSales);

        // calculate times of discount code being used
        $discountCodeUsed = Transaction::where("discount_id", "!=", null)->count();

        // calculate number of customer
        $numCustomer = User::where("role", "customer")->count();

    $reservationsByMonth = Reservation::selectRaw('YEAR(res_date) as year, MONTH(res_date) as month, COUNT(*) as count')
    ->groupBy('year', 'month')
    ->orderBy('year')
    ->orderBy('month')
    ->get();


         // Payment Reservation Analytics
        $paymentsByDate = Payment::selectRaw('DATE(created_at) as date, SUM(amount) as total_amount')
        ->groupBy('date')
        ->orderBy('date')
        ->get();
        
        $startDate = Carbon::parse($lastMonthDate)->format('Y-m-d');
        return view('dashboard', compact("startDate", "today", "totalRevenue", "dailyRevenue", "totalCost", "grossProfit",
                "totalOrders", "dailyOrders", "discountCodeUsed", "numCustomer", "categoricalSales", "finalProductSales", "reservationsByMonth", "paymentsByDate", 'notifications')); 
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

}
