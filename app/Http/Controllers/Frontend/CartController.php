<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            $cart[$product->id]['quantity']++;

        } else {

            $cart[$product->id] = [
                'product_id'   => $product->id,
                'product_name' => $product->product_name,
                'price'        => $product->price,
                'image'        => $product->image,
                'quantity'     => 1,
            ];

        }

        session()->put('cart', $cart);

        return redirect()
            ->back()
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('frontend.cart.index', compact('cart'));
    }

    public function increase(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function decrease(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            if ($cart[$product->id]['quantity'] > 1) {

                $cart[$product->id]['quantity']--;

            } else {

                unset($cart[$product->id]);

            }

        }

        session()->put('cart', $cart);

        return back();
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return back()
            ->with('success', 'Produk dihapus dari keranjang.');
    }
}