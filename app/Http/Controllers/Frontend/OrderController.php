<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
    'items.product',
    'items.product.category',
    'items.product.ratings'
])
->where('user_id', auth()->id())
->latest()
->paginate(10);

        return view(
            'frontend.orders.index',
            compact('orders')
        );
    }

  public function show(Order $order)
{
    abort_if($order->user_id != auth()->id(), 403);

    $order->load('items.product');

    $ratedProducts = Rating::where('user_id', auth()->id())
        ->pluck('product_id')
        ->toArray();

    return view('frontend.orders.show', compact(
        'order',
        'ratedProducts'
    ));
}
}