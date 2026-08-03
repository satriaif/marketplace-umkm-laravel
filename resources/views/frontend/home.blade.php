@extends('layouts.frontend')

@section('content')

{{-- ================= HERO SECTION 2 ================= --}}

<section class="hero-section mb-5">

   <div class="card border-0 rounded-4 overflow-hidden hero-card">

      <div class="card-body p-lg-5 p-4">

         <div class="row align-items-center g-5">

            {{-- ================= LEFT ================= --}}

            <div class="col-lg-6">

               <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">

                  <i class="bi bi-cpu me-2"></i>

                  Marketplace Elektronik UMKM

               </span>

               <h1 class="display-4 fw-bold lh-sm mb-4">

                  Temukan Produk

                  <span class="text-primary">

                     Elektronik

                  </span>

                  Terbaik dari UMKM Indonesia

               </h1>

               <p class="text-muted fs-5 mb-4">

                  TechUMKM menghadirkan berbagai produk elektronik dari UMKM
                  dengan sistem rekomendasi cerdas menggunakan metode
                  <strong>User-Based Collaborative Filtering</strong>
                  sehingga Anda dapat menemukan produk yang sesuai dengan
                  preferensi.

               </p>

               <div class="d-flex flex-wrap gap-3 mb-4">

                  <a href="#produk" class="btn btn-primary btn-lg rounded-pill px-4">

                     <i class="bi bi-bag-fill me-2"></i>

                     Mulai Belanja

                  </a>

                  <a href="#rekomendasi" class="btn btn-outline-primary btn-lg rounded-pill px-4">

                     <i class="bi bi-stars me-2"></i>

                     Rekomendasi

                  </a>

               </div>

               <div class="row g-3">

                  <div class="col-sm-4">

                     <div class="d-flex align-items-center">

                        <i class="bi bi-patch-check-fill text-success fs-4 me-2"></i>

                        <small class="fw-semibold">

                           Produk Berkualitas

                        </small>

                     </div>

                  </div>

                  <div class="col-sm-4">

                     <div class="d-flex align-items-center">

                        <i class="bi bi-lightning-charge-fill text-warning fs-4 me-2"></i>

                        <small class="fw-semibold">

                           Rekomendasi Cerdas

                        </small>

                     </div>

                  </div>

                  <div class="col-sm-4">

                     <div class="d-flex align-items-center">

                        <i class="bi bi-shop text-primary fs-4 me-2"></i>

                        <small class="fw-semibold">

                           UMKM Lokal

                        </small>

                     </div>

                  </div>

               </div>

            </div>

            {{-- ================= RIGHT ================= --}}

            <div class="col-lg-6 text-center">

               <div class="hero-image-wrapper">

                  <img src="{{ asset('images/hero3-elektronik.png') }}" alt="Marketplace Elektronik"
                     class="img-fluid hero-image">

               </div>

            </div>

         </div>

      </div>

   </div>

</section>

<section id="rekomendasi">

   <div class="d-flex justify-content-between align-items-center mb-4">

      <div>

         <h2 class="fw-bold mb-1">

            ⭐ Rekomendasi Untuk Anda

         </h2>

         <p class="text-muted mb-0">

            Produk berikut dipilih berdasarkan histori rating Anda
            menggunakan metode User-Based Collaborative Filtering.

         </p>

      </div>

   </div>

   {{-- card rekomendasi --}}

   @if($recommendations->isEmpty())

   <div class="card border-0 shadow-sm mb-5">

      <div class="card-body p-4 text-center">

         <div class="mb-3">

            <i class="bi bi-stars text-warning" style="font-size:50px;"></i>

         </div>

         <h4 class="fw-bold">

            Belum Ada Rekomendasi

         </h4>

         <p class="text-muted">

            Berikan rating pada beberapa produk terlebih dahulu agar
            sistem dapat mempelajari preferensi Anda menggunakan
            <strong>User-Based Collaborative Filtering.</strong>

         </p>

         <a href="#produk" class="btn btn-primary rounded-pill px-4">

            Jelajahi Produk

         </a>

      </div>

   </div>

   @else

   <div class="row">

      @foreach($recommendations as $item)

      @php
      $product = $item['product'];
      @endphp

      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

         <div class="card product-card h-100 border-0 recommendation-card">

            <img src=" {{ asset('storage/products/'.$product->image) }}" class="card-img-top"
               style="height:220px;object-fit:cover;">

            <div class="card-body">

               <h5>

                  {{ $product->product_name }}

               </h5>

               <small class="text-muted">

                  {{ $product->category->category_name }}

               </small>

               <p class="text-muted mb-1">

                  <i class="bi bi-shop-window"></i>

                  {{ $product->seller->seller_name }}

               </p>

               <p class="fw-bold text-primary">

                  Rp {{ number_format($product->price,0,',','.') }}

               </p>

               <p class="text-warning mb-2">

                  ✨Direkomendasikan Berdasarkan Preferensi Anda
               </p>



               <!-- <p class="text-warning mb-2">

                  ⭐ Prediksi Rating:
                  {{ number_format($item['score'],4) }}

               </p> -->

               <a href="{{ route('products.show',$product->id) }}" class="btn btn-primary w-100 rounded-pill">

                  Lihat Produk

               </a>

            </div>

         </div>

      </div>

      @endforeach

   </div>

   @endif

</section>
<hr class="mb-5">

<h3 id="produk" class="fw-bold mb-4">

   <i class="bi bi-bag-fill text-primary me-2"></i>

   Semua Produk

</h3>



{{-- kategori --}}


<div class="d-flex flex-wrap gap-2 mb-4">

   <h5 class="fw-bold mb-3">

      <i class="bi bi-grid-fill text-primary"></i>

      Kategori

   </h5>

   <a href="{{ route('home') }}#produk"
      class="btn rounded-pill px-4 py-2 {{ request('category') ? 'btn-outline-primary' : 'btn-primary' }}">

      Semua

   </a>

   @foreach($categories as $category)

   <a href="{{ route('home', ['category' => $category->id]) }}#produk"
      class="btn rounded-pill px-4 py-2 {{ request('category') == $category->id ? 'btn-primary' : 'btn-outline-primary' }}">

      {{ $category->category_name }}

   </a>

   @endforeach

</div>

<section id="produk">

   <div id="product-list">

      @include('frontend.partials.products')

   </div>

</section>

<div class="d-flex justify-content-center mt-4">

   {{ $products->links() }}

</div>

@section('js')
<script>
let timer;

const search = document.getElementById('navbar-search');

search.addEventListener('input', function() {

   clearTimeout(timer);

   timer = setTimeout(async () => {

      const keyword = search.value;

      const response = await fetch(
         `/?search=${encodeURIComponent(keyword)}`, {
            headers: {
               'X-Requested-With': 'XMLHttpRequest'
            }
         }
      );

      const html = await response.text();

      document.getElementById('product-list').innerHTML = html;

      document.getElementById('produk').scrollIntoView({
         behavior: 'smooth'
      });

   }, 300);

});
</script>
@endsection
@endsection