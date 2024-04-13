<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'status',
    ];    

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'inventories');
    }

}
