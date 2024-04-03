<?php

namespace App\Enums;

enum ServiceStatus: string
{
    case Available = 'available';
    case Unavailable = 'unavailable';
}
