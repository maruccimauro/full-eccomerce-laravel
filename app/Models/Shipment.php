<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'tracking_number',
        'status',
        'shipped_at',
        'delivered_at'
    ];

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
