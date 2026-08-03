<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()
            ->route('home')
            ->with('error', 'Keranjang masih kosong.');
    }

    return view('frontend.checkout.index', compact('cart'));
}

public function store(Request $request)
{
    $request->validate([
        'recipient_name' => 'required|string|max:255',
        'phone'          => 'required|string|max:20',
        'province'       => 'required|string|max:100',
        'city'           => 'required|string|max:100',
        'postal_code'    => 'required|string|max:10',
        'address'        => 'required|string',
    ]);

    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()
            ->route('cart.index')
            ->with('error', 'Keranjang masih kosong.');
    }

    $order = DB::transaction(function () use ($request, $cart) {

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([

            'user_id' => Auth::id(),

            'recipient_name' => $request->recipient_name,
            'phone'          => $request->phone,
            'province'       => $request->province,
            'city'           => $request->city,
            'postal_code'    => $request->postal_code,
            'address'        => $request->address,

            'total_price' => $total,
            'status'      => 'pending',

        ]);

        foreach ($cart as $item) {

            OrderItem::create([

    'order_id'   => $order->id,
    'product_id' => $item['product_id'],
    'quantity'   => $item['quantity'],
    'price'      => $item['price'],

]);

        }

        return $order;
    });

    session()->forget('cart');

    return redirect()
        ->route('checkout.payment', $order->id)
        ->with('success', 'Pesanan berhasil dibuat.');
}

public function payment(Order $order)
{
    if ($order->user_id != Auth::id()) {
        abort(403);
    }

    return view('frontend.checkout.payment', compact('order'));
}

public function confirmPayment(Order $order)
{
    if ($order->user_id != Auth::id()) {
        abort(403);
    }

    $order->update([
        'status' => 'paid'
    ]);

    return redirect()
        ->route('orders.index')
        ->with('success', 'Pembayaran berhasil dikonfirmasi.');
}
}