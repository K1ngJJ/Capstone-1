@component('mail::message')

# Your reservation was declined

We regret to inform you that your reservation has been declined.

Some details about the reservation...

@component('mail::button', ['url' => 'link'])
More Details
@endcomponent

Thank you, <br>
GiGCafe

@endcomponent
