<!DOCTYPE html>
<html lang="id">

<head>

   <meta charset="UTF-8">

   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>TechUMKM</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

   {{-- Bootstrap 5 --}}
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

   {{-- Bootstrap Icons --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

   <style>
   /* ================= HERO ================= */

   /* ================= HERO IMAGE ================= */
   .hero-image-wrapper::before {

      content: "";

      position: absolute;

      width: 420px;

      height: 420px;

      border-radius: 50%;

      background: #DBEAFE;

      filter: blur(80px);

      opacity: .7;

      z-index: 0;

   }

   .hero-image {

      position: relative;

      z-index: 2;

   }

   @keyframes floating {

      0% {

         transform: translateY(0px);

      }

      50% {

         transform: translateY(-12px);

      }

      100% {

         transform: translateY(0px);

      }

   }

   .hero-image-wrapper {

      position: relative;

      display: flex;

      justify-content: center;

      align-items: center;

   }

   @media (max-width:992px) {

      .hero-image {

         width: 380px;

         margin-top: 30px;

      }

   }

   @media (max-width:576px) {

      .hero-image {

         width: 280px;

      }

   }

   .hero-image {

      max-width: 100%;

      width: 520px;

      animation: floating 5s ease-in-out infinite;

      filter: drop-shadow(0 35px 45px rgba(0, 0, 0, .15));

   }

   .hero-card {
      background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
      border-radius: 28px;
      overflow: hidden;
   }

   .hero-section {

      margin-bottom: 70px;

   }

   .hero-section h1 {
      color: #0F172A;
      line-height: 1.2;
   }

   .hero-section p {
      line-height: 1.8;
   }

   .hero-product-card {
      border-radius: 20px;
      transition: .35s ease;
      overflow: hidden;
      background: #fff;
   }

   .hero-product-card:hover {

      transform: translateY(-8px);

      box-shadow: 0 18px 35px rgba(37, 99, 235, .15);

   }

   .hero-product-image {

      width: 100%;

      height: 170px;

      object-fit: cover;

   }

   .hero-product-card .card-body {

      padding: 18px;

   }

   .hero-product-card {

      position: relative;

   }

   .hero-product-card:nth-child(1) {

      margin-top: 35px;

   }

   .hero-product-card:nth-child(2) {

      margin-top: 0;

   }

   .hero-product-card:nth-child(3) {

      margin-top: -25px;

   }

   .hero-product-card:nth-child(4) {

      margin-top: 15px;

   }

   .hero-section .badge {

      font-size: .9rem;

      font-weight: 600;

      letter-spacing: .3px;

   }

   .hero-section .btn {

      padding: 12px 28px;

      font-weight: 600;

   }

   .hero-section .bi {

      transition: .3s;

   }

   .hero-section .d-flex:hover .bi {

      transform: scale(1.15);

   }

   .hero-card {

      box-shadow:

         0 15px 40px rgba(15, 23, 42, .08);

   }

   @media (max-width:992px) {

      .hero-section {

         text-align: center;

      }

      .hero-product-card {

         margin-top: 0 !important;

      }

      .hero-section .d-flex {

         justify-content: center;

      }

   }

   .hero-product-image {

      transition: .4s;

   }

   .hero-product-card:hover .hero-product-image {

      transform: scale(1.06);

   }

   .product-card {

      border-radius: 20px;

      transition: .25s ease;

      overflow: hidden;

      background: #fff;

      box-shadow:
         0 4px 15px rgba(0, 0, 0, .05);

   }

   .product-card:hover {

      transform: translateY(-6px);

      box-shadow:
         0 18px 35px rgba(0, 0, 0, .12);

   }

   .product-image {

      height: 220px;

      width: 100%;

      object-fit: cover;

      transition: .4s;

   }

   .product-card:hover .product-image {

      transform: scale(1.05);

   }

   .product-title {

      min-height: 52px;

      display: -webkit-box;

      -webkit-line-clamp: 2;

      -webkit-box-orient: vertical;

      overflow: hidden;

   }

   .card .badge {

      font-size: .75rem;

   }

   .btn-primary {

      border-radius: 12px;

   }

   .recommendation-card {

      position: relative;

      overflow: hidden;

   }

   .recommendation-card::before {

      content: "REKOMENDASI";

      position: absolute;

      top: 14px;

      right: -34px;

      transform: rotate(45deg);

      background: #2563EB;

      color: white;

      padding: 4px 40px;

      font-size: 10px;

      font-weight: 600;

      letter-spacing: 1px;

   }

   .product-detail-image {

      width: 100%;

      height: 420px;

      object-fit: cover;

   }

   .summary-card {
      position: sticky;
      top: 90px;
   }

   .table td,
   .table th {
      vertical-align: middle;
   }

   .cart-image {

      width: 130px;
      height: 130px;

      object-fit: cover;

      border-radius: 18px;

      border: 1px solid #e5e7eb;

   }

   .card {

      transition: .25s;

   }

   .card:hover {

      transform: translateY(-4px);

      box-shadow: 0 12px 30px rgba(0, 0, 0, .08);

   }

   .checkout-image {

      width: 90px;

      height: 90px;

      object-fit: cover;

      border-radius: 16px;

      border: 1px solid #e5e7eb;

   }

   .summary-card {

      position: sticky;

      top: 90px;

   }

   .badge {

      font-size: .85rem;

      padding: 8px 14px;

      border-radius: 20px;

   }

   .order-product-image {

      width: 70px;

      height: 70px;

      object-fit: cover;

      border-radius: 12px;

      border: 1px solid #e5e7eb;

      background: #fff;

   }

   .navbar {
      padding: 14px 0;
   }

   .navbar .btn {
      transition: .2s ease;
   }

   .navbar .btn:hover {
      transform: translateY(-2px);
   }

   .navbar-brand {
      letter-spacing: .4px;
   }

   .navbar .form-control {
      border-radius: 50px;
   }

   .navbar .input-group-text {
      border-radius: 50px 0 0 50px;
   }

   .navbar .form-control {
      border-radius: 0 50px 50px 0;
   }
   </style>

</head>

<body>

   {{-- ================= NAVBAR ================= --}}

   <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">

      <div class="container">

         <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">

            <i class="bi bi-shop text-primary fs-3 me-2"></i>

            <div>

               <div class="fw-bold fs-4 text-dark">
                  TechUMKM
               </div>
            </div>

         </a>

         <form action="{{ route('home') }}" method="GET" class="d-flex flex-grow-1 mx-4" onsubmit="return false;">

            <div class="input-group">

               <span class="input-group-text bg-white border-end-0">
                  <i class="bi bi-search"></i>
               </span>

               <input type="text" id="navbar-search" name="search" class="form-control border-start-0"
                  placeholder="Cari produk..." value="{{ request('search') }}">

            </div>

         </form>

         <div class="d-flex align-items-center gap-2">

            <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill me-2">

               <i class="bi bi-house"></i>

               Home

            </a>


            <a href="{{ route('cart.index') }}" class="btn btn-outline-dark rounded-pill position-relative">

               <i class="bi bi-cart"></i>

               Keranjang

               @php
               $cartCount = collect(session('cart', []))->sum('quantity');
               @endphp

               @if($cartCount > 0)

               <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                  {{ $cartCount }}

               </span>

               @endif

            </a>

            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary rounded-pill">

               <i class="bi bi-box-seam"></i>

               Pesanan Saya

            </a>

            @auth

            <div class="dropdown">

               <button class="btn btn-light border rounded-pill dropdown-toggle px-3" data-bs-toggle="dropdown">

                  <i class="bi bi-person-circle me-1"></i>

                  {{ auth()->user()->name }}

               </button>

               <ul class="dropdown-menu dropdown-menu-end">

                  <li>
                     <hr class="dropdown-divider">
                  </li>

                  <li>

                     <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button class="dropdown-item text-danger">

                           <i class="bi bi-box-arrow-right me-2"></i>

                           Logout

                        </button>

                     </form>

                  </li>

               </ul>

            </div>

            @else

            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">

               <i class="bi bi-box-arrow-in-right me-1"></i>

               Login

            </a>

            @endauth

         </div>

      </div>

   </nav>




   {{-- ================= CONTENT ================= --}}

   <div class="container mt-4">

      @yield('content')

   </div>

   {{-- ================= FOOTER ================= --}}

   <footer class="bg-light mt-5 py-4">

      <div class="container text-center">
         <h5 class="fw-bold text-dark">

            TechUMKM

         </h5>
         <p>

            Marketplace UMKM berbasis Web dengan metode
            User-Based Collaborative Filtering.

         </p>
         <small>

            © {{ date('Y') }}

            Marketplace UMKM

         </small>

      </div>

   </footer>
   <!-- <div class="text-center py-5 text-muted">

   <h5 class="fw-bold text-dark">

      TechUMKM

   </h5>

   <p>

      Marketplace UMKM berbasis Web dengan metode
      User-Based Collaborative Filtering.

   </p>

   <small>

      © {{ date('Y') }} TechUMKM. All Rights Reserved.

   </small>

</div> -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   @if(session('success'))

   <!-- <script>
   document.addEventListener("DOMContentLoaded", function() {

      Swal.fire({

         icon: 'success',

         title: 'Rating Berhasil',

         text: 'Terima kasih telah memberikan penilaian terhadap produk ini.',

         confirmButtonText: 'OK'

      });

   });
   </script>

   @endif -->
   @yield('js')

</body>

</html>