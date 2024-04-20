<?php

namespace App\Models;

use App\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image', 'guest_number', 'status', 'menu_id', 'user_id'];

    protected $casts = [
        'status' => PackageStatus::class,
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_group');
    }

    public function reservations()
    {
        return $this->belongsTo(Reservation::class);
    }


}