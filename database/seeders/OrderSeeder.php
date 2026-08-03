<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Rating;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        DB::transaction(function () {

            OrderItem::query()->delete();
            Order::query()->delete();

            // Ambil semua rating lalu kelompokkan berdasarkan user
            $ratingsByUser = Rating::with('product')
                ->orderBy('user_id')
                ->get()
                ->groupBy('user_id');

            // Mayoritas completed karena user sudah memberi rating
            $statuses = [
                'completed',
                'completed',
                'completed',
                'completed',
                'completed',
                'completed',
                'completed',
                'shipped',
                'shipped',
                'processed',
            ];

            foreach ($ratingsByUser as $userId => $ratings) {

                // Acak agar isi order lebih natural
                $ratings = $ratings->shuffle()->values();

                while ($ratings->count() > 0) {

                    // Tiap order berisi 2–5 produk
                    $take = min(rand(2, 5), $ratings->count());

                    $items = $ratings->splice(0, $take);

                    $order = Order::create([
                        'user_id'     => $userId,
                        'total_price' => 0,
                        'status'      => 'completed',
                    ]);

                    $total = 0;

                    foreach ($items as $rating) {

                        $quantity = rand(1, 2);

                        OrderItem::create([
                            'order_id'   => $order->id,
                            'product_id' => $rating->product->id,
                            'quantity'   => $quantity,
                            'price'      => $rating->product->price,
                        ]);

                        $total += $rating->product->price * $quantity;
                    }

                    $order->update([
                        'total_price' => $total,
                    ]);
                }
            }
        });
    }
}