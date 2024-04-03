<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'final_amount',
    ];

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
