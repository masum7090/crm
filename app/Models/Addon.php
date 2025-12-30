<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'price',
        'billing_cycle',
        'type',
        'is_active',
        'is_popular',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
