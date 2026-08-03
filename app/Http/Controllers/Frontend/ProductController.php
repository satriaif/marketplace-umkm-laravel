<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('category');

        return view('frontend.product.show', compact('product'));
    }
}