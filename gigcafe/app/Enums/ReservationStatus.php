<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Fulfilled = 'Fulfilled';
    case InProgress = 'In Progress';
    case Approved = 'Approved';
    case Declined = 'Declined';
    case Cancelled = 'Cancelled';
    case Pending = 'Pending';
    
}
