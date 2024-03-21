<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order_details(): HasMany
    {
        return $this->hasMany(Order_Details::class);
    }
}