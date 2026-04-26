<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body_html',
        'handle',
        'sort_order',
        'collection_type',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function collects(): HasMany
    {
        return $this->hasMany(Collect::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'collects')
            ->withPivot(['position', 'sort_value']);
    }
}
