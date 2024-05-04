<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    
    public function generatePdf()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        $transactions = Transaction::get();

        $data = [
            'title' => 'Sales Report',
            'date' => date('m/d/Y'),
            'transactions' => $transactions
        ];

        $pdf = Pdf::loadView('transactions.generate-transactions-pdf', $data);
        return $pdf->download('transactions-data.pdf');
    }
}
