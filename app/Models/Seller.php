<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'seller_name',
        'owner_name',
        'phone',
        'address',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}