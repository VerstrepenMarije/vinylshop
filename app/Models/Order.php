<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relationship: An Order belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    // Relationship: An Order has many Orderlines
    public function orderlines(): HasMany
    {
        return $this->hasMany(Orderline::class);
    }
}
