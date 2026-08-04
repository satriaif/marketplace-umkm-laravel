<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
   public function store(Request $request, Product $product)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Rating::firstOrCreate(

        [
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ],

        [
            'rating' => $request->rating,
        ]

    );

        return redirect()
            ->back()
            ->with('rating_success', 'Terima kasih telah memberikan penilaian.');
}
}