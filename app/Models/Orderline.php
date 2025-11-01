<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Orderline extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relationship: An Orderline belongs to an Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class)->withDefault();
    }
}
