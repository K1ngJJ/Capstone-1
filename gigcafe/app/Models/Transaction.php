<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'discount_id',
        'final_amount',
        'created_at',
    ];

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
