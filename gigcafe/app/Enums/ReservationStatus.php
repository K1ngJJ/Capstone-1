<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Fulfilled = 'Fulfilled';
    case Notfulfilled = 'Not Fulfilled';
}
