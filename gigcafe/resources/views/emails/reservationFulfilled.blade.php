@component('mail::message')

# Your reservation was fulfilled

Your reservation has been successfully fulfilled.

Some details about the reservation...

@component('mail::button', ['url' => 'link'])
More Details
@endcomponent

Thank you, <br>
GiGCafe

@endcomponent
