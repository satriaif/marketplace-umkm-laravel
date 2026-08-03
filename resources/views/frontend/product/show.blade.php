@extends('layouts.frontend')

@section('content')

<nav class="mb-4">

   <ol class="breadcrumb">

      <li class="breadcrumb-item">

         <a href="{{ route('home') }}">Home</a>

      </li>

      <li class="breadcrumb-item">

         {{ $product->category->category_name }}

      </li>

      <li class="breadcrumb-item active">

         {{ $product->product_name }}

      </li>

   </ol>

</nav>

<div class="card border-0 shadow-sm rounded-4">

   <div class="card-body p-5">

      <div class="row">

         <div class="col-md-5">

            <img src="{{ asset('storage/products/'.$product->image) }}"
               class="img-fluid rounded-4 product-detail-image">
         </div>

         <div class="col-md-7">

            <h1 class="fw-bold mb-3">

               {{ $product->product_name }}

            </h1>

            <h2 class="text-primary fw-bold mb-4">

               Rp {{ number_format($product->price,0,',','.') }}

            </h2>

            <div class="card mt-2 border-0 shadow-sm">

               <div class="card-body">

                  <h4 class="fw-bold mb-3">

                     Deskripsi Produk

                  </h4>

                  <p class="text-secondary">

                     {{ $product->description }}

                  </p>

               </div>

            </div>

            <div class="mb-4">

               <div class="row mb-2">

                  <div class="col-4 text-muted">

                     Kategori

                  </div>

                  <div class="col-8 fw-semibold">

                     {{ $product->category->category_name }}

                  </div>

               </div>

               <div class="row mb-2">

                  <div class="col-4 text-muted">

                     Penjual

                  </div>

                  <div class="col-8 fw-semibold">

                     {{ $product->seller->seller_name }}

                  </div>

               </div>

               <div class="row">

                  <div class="col-4 text-muted">

                     Stok

                  </div>

                  <div class="col-8">

                     @if($product->stock>0)

                     <span class="badge bg-success">

                        {{ $product->stock }} tersedia

                     </span>

                     @else

                     <span class="badge bg-danger">

                        Habis

                     </span>

                     @endif

                  </div>

               </div>

            </div>

            <div class="mt-4">

               <form action="{{ route('cart.add',$product->id) }}" method="POST">

                  @csrf

                  <button class="btn btn-primary btn-lg w-100 rounded-pill">

                     <i class="bi bi-cart-plus"></i>

                     Tambah ke Keranjang

                  </button>
               </form>

            </div>
         </div>




      </div>

   </div>

</div>

</div>

@endsection