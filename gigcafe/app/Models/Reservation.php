<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'tel_number',
        'email',
        'package_id',
        'service_id',
        'status',
        'res_date',
        'guest_number'
    ];

    protected $dates = [
        'res_date'
    ];



    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}