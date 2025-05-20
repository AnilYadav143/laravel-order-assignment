<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryAssignment extends Model
{
    protected $fillable = [
        'delivery_boy_id',
        'order_id',
        'assigned_at',
    ];


    public function deliveryBoy()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
}
