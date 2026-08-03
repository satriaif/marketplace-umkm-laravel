@extends('layouts.frontend')

@section('content')

<h2 class="fw-bold mb-4">
   💳 Checkout
</h2>

@php
$total = 0;
@endphp

<form action="{{ route('checkout.store') }}" method="POST">

   @csrf

   <div class="row">

      {{-- Produk + Data Penerima --}}
      <div class="col-lg-8">

         {{-- Produk --}}
         @foreach($cart as $item)

         @php
         $subtotal = $item['price'] * $item['quantity'];
         $total += $subtotal;
         @endphp

         <div class="card border-0 shadow-sm rounded-4 mb-3">

            <div class="card-body">

               <div class="row align-items-center">

                  <div class="col-md-2">

                     <img src="{{ asset('storage/products/'.$item['image']) }}" class="checkout-image">

                  </div>

                  <div class="col-md-6">

                     <h5 class="fw-bold">
                        {{ $item['product_name'] }}
                     </h5>

                     <p class="text-muted mb-1">
                        Qty : {{ $item['quantity'] }}
                     </p>

                     <p class="text-muted">
                        Harga :
                        Rp {{ number_format($item['price'],0,',','.') }}
                     </p>

                  </div>

                  <div class="col-md-4 text-end">

                     <h5 class="text-primary fw-bold">
                        Rp {{ number_format($subtotal,0,',','.') }}
                     </h5>

                  </div>

               </div>

            </div>

         </div>

         @endforeach

         {{-- Data Penerima --}}
         <div class="card border-0 shadow-sm rounded-4 mt-4">

            <div class="card-body">

               <h4 class="fw-bold mb-4">
                  📦 Data Penerima
               </h4>

               <div class="row">

                  <div class="col-md-6 mb-3">

                     <label class="form-label">
                        Nama Lengkap
                     </label>

                     <input type="text" name="recipient_name" class="form-control"
                        value="{{ old('recipient_name', Auth::user()->name) }}" required>

                  </div>

                  <div class="col-md-6 mb-3">

                     <label class="form-label">
                        Nomor HP
                     </label>

                     <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>

                  </div>

                  <div class="col-md-6 mb-3">

                     <label class="form-label">
                        Provinsi
                     </label>

                     <input type="text" name="province" class="form-control" value="{{ old('province') }}" required>

                  </div>

                  <div class="col-md-6 mb-3">

                     <label class="form-label">
                        Kota / Kabupaten
                     </label>

                     <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>

                  </div>

                  <div class="col-md-6 mb-3">

                     <label class="form-label">
                        Kode Pos
                     </label>

                     <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}"
                        required>

                  </div>

                  <div class="col-12">

                     <label class="form-label">
                        Alamat Lengkap
                     </label>

                     <textarea name="address" rows="4" class="form-control" required>{{ old('address') }}</textarea>

                  </div>

               </div>

            </div>

         </div>

      </div>

      {{-- Ringkasan --}}
      <div class="col-lg-4">

         <div class="card border-0 shadow-sm rounded-4 summary-card">

            <div class="card-body">

               <h4 class="fw-bold mb-4">
                  Ringkasan Pembayaran
               </h4>

               <div class="d-flex justify-content-between mb-3">

                  <span>Total Produk</span>

                  <strong>{{ count($cart) }}</strong>

               </div>

               <hr>

               <div class="d-flex justify-content-between mb-4">

                  <h5>Total</h5>

                  <h3 class="text-primary fw-bold">

                     Rp {{ number_format($total,0,',','.') }}

                  </h3>

               </div>

               <button type="submit" class="btn btn-success w-100 rounded-pill btn-lg">

                  <i class="bi bi-credit-card"></i>

                  Lanjut ke Pembayaran

               </button>

            </div>

         </div>

      </div>

   </div>

</form>

@endsection