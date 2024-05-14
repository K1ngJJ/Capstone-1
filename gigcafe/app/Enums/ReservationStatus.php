<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Fulfilled = 'Fulfilled';
    case NotFulfilled = 'Not Fulfilled';
    case Pending = 'Pending';
    case Cancel = 'Cancel';
}
