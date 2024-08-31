<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimeBetween implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value); // Parse the pickup date and time
        $pickupTime = Carbon::createFromFormat('g:i A', $pickupDate->format('g:i A')); // Create time in 12-hour format

        // Define restaurant opening and closing times in 12-hour format
        $earliestTime = Carbon::createFromFormat('g:i A', '8:00 AM');
        $lastTime = Carbon::createFromFormat('g:i A', '8:00 PM');

        // Check if the pickup time falls within the open hours
        return $pickupTime->between($earliestTime, $lastTime);
    }

//    public function passes($attribute, $value)
//    {
//        $pickupDate = Carbon::parse($value);
//        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);
        // when the restaurant is open
//        $earliestTime = Carbon::createFromTimeString('08:00:00');
//        $lastTime = Carbon::createFromTimeString('20:00:00');

//        return $pickupTime->between($earliestTime, $lastTime) ? true : false;
//    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose the time between 8:00 AM - 8:00 PM.';
    }
}
