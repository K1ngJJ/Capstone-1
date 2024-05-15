@component('mail::message')

# Your reservation was Fulfilled

Some details about the reservation...

@component('mail::button', ['url' => 'link']) 
More Details
@endcomponent

Thanks, <br>

GiGCafe

@endcomponent
