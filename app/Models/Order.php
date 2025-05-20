<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number_order',
    ];
    public function deliveryAssignments()
    {
        return $this->hasOne(DeliveryAssignment::class);
    }
    public function deliveryBoys()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
}
