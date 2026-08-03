<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'seller_id',
        'category_id',
        'product_name',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

   public function ratings()
{
    return $this->hasMany(Rating::class);
}

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function seller()
{
    return $this->belongsTo(Seller::class);
}
}