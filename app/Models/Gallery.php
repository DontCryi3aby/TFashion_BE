<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}