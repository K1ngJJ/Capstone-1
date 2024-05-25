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


       // Calculate number of customers
        $numCustomer = User::where("role", "customer")->count();






        //RESERVATIONS

        // General variables useful for all charts / graphs
        $rtoday = Carbon::today()->toDateString();
        $lastMonthDate = Carbon::now()->subDays(30)->toDateString();

        // Transactions within the last 30 days
        $oneMonthPayments = Payment::where('created_at', '>=', $lastMonthDate)->get();

        // Start date for the charts (last 30 days)
        $rstartDate = $lastMonthDate;

        // Calculate number of reservations by month with status 'Fulfilled' within the last 30 days
        $reservationsByMonth = Reservation::where('status', 'Fulfilled')
            ->where('res_date', '>=', $lastMonthDate)
            ->selectRaw('YEAR(res_date) as year, MONTH(res_date) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Calculate number of reservations by week with status 'Fulfilled' within the last 30 days
        $reservationsByWeek = Reservation::where('status', 'Fulfilled')
            ->where('res_date', '>=', $lastMonthDate)
            ->selectRaw('YEAR(res_date) as year, WEEK(res_date, 1) as week, COUNT(*) as count')
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        // Calculate number of customers who made reservations
        $resCustomer = Reservation::distinct('user_id')->count('user_id');
        // Calculate number of reservations by month with status 'Fulfilled'
        $reservationsByMonth = Reservation::where('status', 'Fulfilled')
        ->selectRaw('YEAR(res_date) as year, MONTH(res_date) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // Calculate number of reservations by week with status 'Fulfilled'
        $reservationsByWeek = Reservation::where('status', 'Fulfilled')
            ->selectRaw('YEAR(res_date) as year, WEEK(res_date, 1) as week, COUNT(*) as count')
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        // Calculate total number of reservations with status 'Fulfilled'
        $totalReservations = Reservation::where('status', 'Fulfilled')->count();



         // Get payments by date for reservations with status 'Fulfilled'
        $paymentsByDate = Payment::join('reservations', 'payments.reservation_id', '=', 'reservations.id')
            ->where('reservations.status', 'Fulfilled')
            ->selectRaw('DATE(payments.created_at) as date, SUM(payments.amount) as total_amount')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Calculate the total amount of all payments for fulfilled reservations
        $totalAmount = $paymentsByDate->sum('total_amount');

        //END RESERVATIONS
        
        $startDate = Carbon::parse($lastMonthDate)->format('Y-m-d');
        return view('dashboard', compact("startDate", "today", "totalRevenue", "dailyRevenue", "totalCost", "grossProfit",
                "totalOrders", "dailyOrders", "discountCodeUsed", "numCustomer", "categoricalSales", "finalProductSales", "rstartDate", "rtoday", "resCustomer", "reservationsByMonth", "reservationsByWeek", "totalReservations", "totalAmount", 'notifications')); 
    }

}
