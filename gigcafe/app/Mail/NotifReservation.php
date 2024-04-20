<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifReservation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
{
    // Get the authenticated user's email address
    $customerEmail = auth()->user()->email;

    return $this
        ->from('gigcafe026@gmail.com')
        ->to($customerEmail) // Set the recipient to the authenticated user's email
        ->subject('Your reservation was confirmed')
        ->markdown('emails.NotifReserve');
}
}
