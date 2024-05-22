<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'package_id', 'user_id', 'reserv_id', 'rated', 'service_rating', 'package_rating', 'comment'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserv_id');
    }
}
