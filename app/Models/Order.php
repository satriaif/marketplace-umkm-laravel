<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;
use App\Models\User;



class Order extends Model
{
   protected $fillable = [

    'user_id',

    'recipient_name',

    'phone',

    'province',

    'city',

    'postal_code',

    'address',

    'total_price',

    'status',

];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function items()
{
    return $this->hasMany(OrderItem::class);
}
}