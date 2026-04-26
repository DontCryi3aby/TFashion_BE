<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body_html',
        'vendor',
        'product_type',
        'handle',
        'status',
        'published_at',
        'quantity',
        'price',
        'discount',
        'deleted',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'deleted' => 'boolean',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function collects(): HasMany
    {
        return $this->hasMany(Collect::class);
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'collects')
            ->withPivot(['position', 'sort_value']);
    }

    public function order_details(): HasMany
    {
        return $this->hasMany(Order_Details::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
