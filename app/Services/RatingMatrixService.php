<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;

class RatingMatrixService
{
    /**
     * Membentuk matriks rating user × produk.
     *
     * Format:
     * [
     *   user_id => [
     *      product_id => rating
     *   ]
     * ]
     */
    public function getMatrix(): array
    {
        $matrix = [];

        // Ambil semua user biasa
        $users = User::where('role', 'user')->pluck('id');

        // Ambil semua produk
        $products = Product::pluck('id');

        // Inisialisasi semua nilai menjadi 0
        foreach ($users as $userId) {

            foreach ($products as $productId) {

                $matrix[$userId][$productId] = 0;

            }

        }

        // Isi rating yang ada
        $ratings = Rating::all();

        foreach ($ratings as $rating) {

            $matrix[$rating->user_id][$rating->product_id] = $rating->rating;

        }

        return $matrix;
    }
}