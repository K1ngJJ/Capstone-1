<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Reservation;

class ReservationDateAvailable implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        // Check if any reservation exists for the given date and user ID
        $existingReservation = Reservation::where('res_date', $value)
            ->where('user_id', '!=', $this->userId) // Exclude current user's reservations
            ->exists();

        // Return true if no reservation exists for the given date and user ID, otherwise false
        return !$existingReservation;
    }

    public function message()
    {
        return 'The selected date is not available for reservation.';
    }
}
