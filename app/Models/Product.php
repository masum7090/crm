<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'sale_price',
        'offer_price',
        'intro_price_1y',
        'intro_price_2y',
        'intro_price_3y',
        'renewal_price_1y',
        'renewal_price_2y',
        'renewal_price_3y',
        'monthly_price',
        'icon',
        'image',
        'meta',
        'category_id',
        'subcategory_id',
        'is_active',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'offer_price' => 'decimal:2',
        'intro_price_1y' => 'decimal:2',
        'intro_price_2y' => 'decimal:2',
        'intro_price_3y' => 'decimal:2',
        'renewal_price_1y' => 'decimal:2',
        'renewal_price_2y' => 'decimal:2',
        'renewal_price_3y' => 'decimal:2',
        'monthly_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function Subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function addons()
    {
        return $this->belongsToMany(Addon::class);
    }
}
