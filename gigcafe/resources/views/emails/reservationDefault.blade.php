<!-- resources/views/emails/reservationDefault.blade.php -->

@component('mail::message')
# Your reservation status update

There has been an update to your reservation status.

Some details about the reservation...

@component('mail::button', ['url' => 'link'])
More Details
@endcomponent

Thank you, <br>
GiGCafe
@endcomponent
