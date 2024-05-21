<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Reservation;
use Carbon\Carbon;

class UniqueReservationDate implements Rule
{
    private $role;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($role)
    {
        $this->role = $role;
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
        $reservationCount = Reservation::where('role', $this->role)
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
        return 'A reservation already exists for this date. Please choose another date.';
    }
}
