<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Reservation;
use Carbon\Carbon;

class OneReservationPerDay implements Rule
{
    private $email;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
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
        $reservationCount = Reservation::where('email', $this->email)
        ->whereDate('res_date', Carbon::parse($value))
        ->count();

         return $reservationCount === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have already made a reservation for this day.';
    }
}
