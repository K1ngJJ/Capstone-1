<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    
    public function orderstxnPdf()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        $orderstxn = Transaction::get();

        $data = [
            'title' => 'Sales Report',
            'date' => date('m/d/Y'),
            'orderstxn' => $orderstxn
        ];

        $pdf = Pdf::loadView('reports.generate-orderstxn-pdf', $data);
        return $pdf->download('OrdersTxn-data.pdf');
    }

    public function reservationstxnPdf()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
    
        $reservationstxn = Reservation::with('service', 'package')->get();
    
        $data = [
            'title' => 'Reservations Report',
            'date' => date('m/d/Y'),
            'reservationstxn' => $reservationstxn
        ];
    
        $pdf = Pdf::loadView('reports.generate-reservationstxn-pdf', $data);
        return $pdf->download('ReservationsTxn-data.pdf');
    }
    

    public function reservationPdf($id)
    {
        // Find the reservation with related service and package
        $reservation = Reservation::with('service', 'package')->findOrFail($id);

        // Retrieve inventory supplies using the new method
        $inventorySupplies = $reservation->inventory_supplies()->get();

        // Prepare data for PDF including inventory supplies
        $data = [
            'title' => 'Reservation Details',
            'date' => date('m/d/Y'),
            'reservation' => $reservation,
            'inventorySupplies' => $inventorySupplies,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('reports.generate-reservation-pdf', $data);

        // Download PDF
        return $pdf->download("Reservation-{$reservation->id}.pdf");
    }

    public function transactionPdf($id)
    {
        $transactions = Transaction::with('order.user', 'order.cartItems.menu')->findOrFail($id);

        $data = [
            'title' => 'Transaction Details',
            'date' => date('m/d/Y'),
            'transactions' => $transactions,
        ];

        $pdf = Pdf::loadView('reports.generate-order-transaction-pdf', $data);
        return $pdf->download("Transaction-{$transactions->id}.pdf");
    }

    
    
}
