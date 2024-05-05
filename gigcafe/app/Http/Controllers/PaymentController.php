<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\Reservation;

class PaymentController extends Controller
{
    private $gateway;
  
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
        return $this->middleware('auth');
    }
  
    /**
     * Call a view.
     */
    public function index()
    {
        $user = auth()->user();
    
        // Check if the user is a customer
        if ($user->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        // Retrieve reservations belonging to the current customer
        $reservations = Reservation::where('email', $user->email)->get();
    
        // Pass reservation IDs to the view
        return view('reservations.thankyou', ['reservations' => $reservations]);
    }
    
  
   /**
 * Initiate a payment on PayPal.
 *
 * @param  \Illuminate\Http\Request  $request
 */
public function charge(Request $request)
{
    if (auth()->user()->role != 'customer') {
        abort(403, 'This route is only meant for customers.');
    }

    // Get the selected reservation ID from the form
    $reservationId = $request->input('reservation_id');

    if ($request->input('submit')) {
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->input('amount'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();
       
            if ($response->isRedirect()) {
                // Save payment details and reservation ID in session
                $request->session()->put('payment_details', [
                    'amount' => $request->input('amount'),
                    'reservation_id' => $reservationId,
                ]);

                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}


  
   /**
 * Charge a payment and store the transaction.
 *
 * @param  \Illuminate\Http\Request  $request
 */
public function success(Request $request)
{
    if (auth()->user()->role != 'customer') {
        abort(403, 'This route is only meant for customers.');
    }

    // Retrieve payment and reservation details from session
    $paymentDetails = $request->session()->get('payment_details');

    // Once the transaction has been approved, we need to complete it.
    if ($request->input('paymentId') && $request->input('PayerID') && $paymentDetails) {
        $reservationId = $paymentDetails['reservation_id'];

        $transaction = $this->gateway->completePurchase(array(
            'payer_id'             => $request->input('PayerID'),
            'transactionReference' => $request->input('paymentId'),
        ));
        $response = $transaction->send();
      
        if ($response->isSuccessful()) {
            // The customer has successfully paid.
            $arr_body = $response->getData();
      
            // Insert transaction data into the database
            $payment = new Payment;
            $payment->payment_id = $arr_body['id'];
            $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
            $payment->payer_email = $arr_body['payer']['payer_info']['email'];
            $payment->amount = $paymentDetails['amount'];
            $payment->currency = env('PAYPAL_CURRENCY');
            $payment->payment_status = $arr_body['state'];
            $payment->reservation_id = $reservationId; // Link payment to reservation
            $payment->save();
      
            return "Payment is successful. Your transaction id is: ". $arr_body['id'];
        } else {
            return $response->getMessage();
        }
    } else {
        return 'Transaction is declined';
    }
}

  
    /**
     * Error Handling.
     */
    public function error()
    {
        if (auth()->user()->role != 'customer')
        abort(403, 'This route is only meant for customers.');
    
        return 'User cancelled the payment.';
    }
}
