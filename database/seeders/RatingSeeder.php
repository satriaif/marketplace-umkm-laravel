<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        
        // Hapus seluruh rating lama
        Rating::truncate();

        // Ambil seluruh produk beserta kategorinya
        $products = Product::with('category')->get();

        /*
        |--------------------------------------------------------------------------
        | Profil User
        |--------------------------------------------------------------------------
        */

        $profiles = [

            // Office
            2  => 'office',
            3  => 'office',
            4  => 'office',
            5  => 'office',

            // Gaming
            6  => 'gaming',
            7  => 'gaming',
            8  => 'gaming',
            9  => 'gaming',

            // Storage
            10 => 'storage',
            11 => 'storage',
            12 => 'storage',

            // Multimedia
            13 => 'multimedia',
            14 => 'multimedia',
            15 => 'multimedia',
            16 => 'multimedia',

        ];

        /*
        |--------------------------------------------------------------------------
        | Bobot Minat
        |--------------------------------------------------------------------------
        */

        $weights = [

            'office' => [

                'Mouse'      => 5,
                'Keyboard'   => 5,
                'Monitor'    => 4,
                'SSD'        => 3,
                'Flashdisk'  => 3,
                'Speaker'    => 2,
                'Webcam'     => 2,
                'Headset'    => 1,

            ],

            'gaming' => [

                'Mouse'      => 5,
                'Keyboard'   => 5,
                'Headset'    => 5,
                'Monitor'    => 3,
                'SSD'        => 3,
                'Speaker'    => 2,
                'Flashdisk'  => 2,
                'Webcam'     => 1,

            ],

            'storage' => [

                'SSD'        => 5,
                'Flashdisk'  => 5,
                'Mouse'      => 2,
                'Keyboard'   => 2,
                'Monitor'    => 2,
                'Speaker'    => 2,
                'Headset'    => 1,
                'Webcam'     => 1,

            ],

            'multimedia' => [

                'Speaker'    => 5,
                'Webcam'     => 5,
                'Monitor'    => 5,
                'Mouse'      => 2,
                'Keyboard'   => 2,
                'SSD'        => 2,
                'Flashdisk'  => 2,
                'Headset'    => 2,

            ],

        ];

        $individualPreference = [

    // ===== OFFICE =====

    2 => [
        'Mouse' => 1,
        'Keyboard' => -1,
    ],

    3 => [
        'Keyboard' => 1,
        'Monitor' => 1,
    ],

    4 => [
        'Mouse' => -1,
        'SSD' => 1,
    ],

    5 => [
        'Monitor' => 1,
        'Flashdisk' => 1,
    ],

    // ===== GAMING =====

    6 => [
        'Headset' => 1,
    ],

    7 => [
        'Mouse' => 1,
    ],

    8 => [
        'Keyboard' => 1,
        'SSD' => 1,
    ],

    9 => [
        'Monitor' => 1,
    ],

    // ===== STORAGE =====

    10 => [
        'SSD' => 1,
    ],

    11 => [
        'Flashdisk' => 1,
        'Keyboard' => 1,
    ],

    12 => [
        'SSD' => 1,
        'Mouse' => 1,
    ],

    // ===== MULTIMEDIA =====

    13 => [
        'Speaker' => 1,
    ],

    14 => [
        'Webcam' => 1,
    ],

    15 => [
        'Monitor' => 1,
    ],

    16 => [
        'Speaker' => 1,
        'Monitor' => 1,
    ],

];

 $ratingBehavior = [

    2  => 'generous',
    3  => 'normal',
    4  => 'critical',
    5  => 'normal',

    6  => 'generous',
    7  => 'critical',
    8  => 'normal',
    9  => 'normal',

    10 => 'critical',
    11 => 'normal',
    12 => 'generous',

    13 => 'generous',
    14 => 'critical',
    15 => 'normal',
    16 => 'critical',

];



       /*
|--------------------------------------------------------------------------
| Generate Rating
|--------------------------------------------------------------------------
*/

foreach ($profiles as $userId => $profile) {

    // Menampung seluruh produk yang dipilih user
    $selectedProducts = collect();

    // Ambil produk berdasarkan bobot tiap kategori
    foreach ($weights[$profile] as $category => $value) {

        $categoryProducts = $products
            ->filter(function ($product) use ($category) {
                return $product->category->category_name == $category;
            })
            ->shuffle()
            ->values();

        if ($value >= 5) {

            $take = rand(3, 4);

        } elseif ($value == 4) {

            $take = rand(2, 3);

        } elseif ($value == 3) {

            $take = rand(1, 2);

        } elseif ($value == 2) {

            $take = rand(1, 2);

        } else {

            $take = rand(0, 1);

        }

        $selectedProducts = $selectedProducts->merge(
            $categoryProducts->take($take)
        );
    }

    // Hilangkan duplikat
    $selectedProducts = $selectedProducts->unique('id');

    // Tambahkan sedikit produk acak dari kategori lain
    $randomProducts = $products
        ->whereNotIn('id', $selectedProducts->pluck('id'))
        ->shuffle()
        ->take(rand(3, 6));

    $selectedProducts = $selectedProducts->merge($randomProducts);

    // Acak kembali lalu batasi jumlah rating user
    $selectedProducts = $selectedProducts
        ->unique('id')
        ->shuffle()
        ->take(rand(15, 20));

    foreach ($selectedProducts as $product) {

        $category = $product->category->category_name;

        $weight = $weights[$profile][$category] ?? 1;

        // Preferensi individual
        if (isset($individualPreference[$userId][$category])) {

            $weight += $individualPreference[$userId][$category];

        }

        // Batasi bobot
        $weight = max(1, min(5, $weight));

        $rating = $this->generateRating(
            $weight,
            $ratingBehavior[$userId]
        );

        Rating::create([
            'user_id'    => $userId,
            'product_id' => $product->id,
            'rating'     => $rating,
        ]);
    }
}
    }
private function generateRating(int $weight, string $behavior): int
{
    switch ($behavior) {

        /*
        |--------------------------------------------------------
        | User yang mudah puas
        |--------------------------------------------------------
        */

        case 'generous':

            return match ($weight) {

                5 => rand(1,100) <= 80 ? 5 : 4,

                4 => rand(1,100) <= 70 ? 4 : 5,

                3 => rand(3,4),

                2 => rand(2,3),

                default => rand(1,2),

            };

        /*
        |--------------------------------------------------------
        | User normal
        |--------------------------------------------------------
        */

        case 'normal':

            return match ($weight) {

                5 => rand(4,5),

                4 => rand(3,5),

                3 => rand(2,4),

                2 => rand(2,3),

                default => rand(1,2),

            };

        /*
        |--------------------------------------------------------
        | User kritis
        |--------------------------------------------------------
        */

        case 'critical':

            return match ($weight) {

                5 => rand(3,5),

                4 => rand(3,4),

                3 => rand(2,3),

                2 => rand(1,3),

                default => rand(1,2),

            };

        default:

            return rand(3,5);

    }
}
}