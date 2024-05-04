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
    
    
    
}
