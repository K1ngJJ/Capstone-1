@component('mail::message')

# Your reservation was approved

We are pleased to inform you that your reservation has been approved.

Some details about the reservation...

@component('mail::button', ['url' => 'link'])
More Details
@endcomponent

Thank you, <br>
GiGCafe

@endcomponent
