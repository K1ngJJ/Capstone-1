<?php

namespace App\Enums;

enum PackageStatus: string
{
    case Available = 'available';
    case Unavailable = 'Unavailable';
}
