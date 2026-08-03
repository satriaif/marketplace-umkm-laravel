@extends('layouts.frontend')

@section('content')

<h2 class="fw-bold mb-4">
   🛒 Keranjang Belanja
</h2>

@if(count($cart) > 0)

@php
$total = 0;
@endphp

<div class="row">

   {{-- Daftar Produk --}}
   <div class="col-lg-8">

      @foreach($cart as $item)

      @php
      $subtotal = $item['price'] * $item['quantity'];
      $total += $subtotal;
      @endphp

      <div class="card border-0 shadow-sm rounded-4 mb-4">

         <div class="card-body p-4">

            <div class="row align-items-center">

               {{-- Gambar --}}
               <div class="col-md-3 text-center">

                  <img src="{{ asset('storage/products/'.$item['image']) }}" class="cart-image">

               </div>

               {{-- Informasi --}}
               <div class="col-md-5">

                  <h5 class="fw-bold mb-2">

                     {{ $item['product_name'] }}

                  </h5>

                  <p class="text-muted mb-2">

                     Harga

                  </p>

                  <h5 class="text-primary fw-bold">

                     Rp {{ number_format($item['price'],0,',','.') }}

                  </h5>

               </div>

               {{-- Quantity --}}
               <div class="col-md-2">

                  <div class="d-flex justify-content-center align-items-center">

                     <form action="{{ route('cart.decrease',$item['product_id']) }}" method="POST">

                        @csrf

                        <button class="btn btn-outline-primary">

                           -

                        </button>

                     </form>

                     <span class="mx-3 fw-bold">

                        {{ $item['quantity'] }}

                     </span>

                     <form action="{{ route('cart.increase',$item['product_id']) }}" method="POST">

                        @csrf

                        <button class="btn btn-outline-primary">

                           +

                        </button>

                     </form>

                  </div>

               </div>

               {{-- Harga + Hapus --}}
               <div class="col-md-2 text-end">

                  <h5 class="fw-bold text-primary">

                     Rp {{ number_format($subtotal,0,',','.') }}

                  </h5>

                  <form action="{{ route('cart.remove',$item['product_id']) }}" method="POST" class="mt-3">

                     @csrf
                     @method('DELETE')

                     <button class="btn btn-outline-danger btn-sm">

                        <i class="bi bi-trash"></i>

                        Hapus

                     </button>

                  </form>

               </div>

            </div>

         </div>

      </div>

      @endforeach

   </div>

   {{-- Ringkasan --}}
   <div class="col-lg-4">

      <div class="card shadow-sm border-0 rounded-4 summary-card">

         <div class="card-body">

            <h4 class="fw-bold mb-4">

               Ringkasan Belanja

            </h4>

            <div class="d-flex justify-content-between mb-3">

               <span>Total Produk</span>

               <strong>{{ count($cart) }}</strong>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-4">

               <h5>Total</h5>

               <h4 class="text-primary fw-bold">

                  Rp {{ number_format($total,0,',','.') }}

               </h4>

            </div>

            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 rounded-pill">

               <i class="bi bi-credit-card"></i>

               Checkout

            </a>

         </div>

      </div>

   </div>

</div>

@else

<div class="card border-0 shadow-sm rounded-4">

   <div class="card-body text-center py-5">

      <i class="bi bi-cart-x display-1 text-secondary"></i>

      <h3 class="fw-bold mt-3">

         Keranjang Anda Masih Kosong

      </h3>

      <p class="text-muted">

         Tambahkan produk terlebih dahulu untuk melanjutkan pembelian.

      </p>

      <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4">

         Jelajahi Produk

      </a>

   </div>

</div>

@endif

@endsection