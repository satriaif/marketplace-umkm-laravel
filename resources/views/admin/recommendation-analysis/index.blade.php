@extends('adminlte::page')

@section('title', 'Analisis Rekomendasi Produk')

@section('content')

<div class="container-fluid">

   <h2 class="fw-bold mb-4">

      <i class="fas fa-chart-line text-primary"></i>

      Analisis Rekomendasi Produk

   </h2>

   <p class="text-muted">

      Halaman ini digunakan untuk menganalisis proses pembentukan rekomendasi
      menggunakan metode <strong>User-Based Collaborative Filtering</strong>.

   </p>

   <div class="card mb-4 shadow-sm">

      <div class="card-header">

         <h5 class="mb-0">

            <i class="fas fa-users text-primary"></i>

            Pilih Pengguna yang Akan Dianalisis

         </h5>

      </div>

      <div class="card-body">

         <form method="GET">

            <div class="row align-items-end">

               <div class="col-md-6">

                  <label class="form-label fw-bold">

                     Pengguna

                  </label>

                  <select name="user_id" class="form-select" onchange="this.form.submit()">

                     @foreach($users as $u)

                     <option value="{{ $u->id }}" {{ $u->id == $userId ? 'selected' : '' }}>

                        {{ $u->name }} ({{ $u->ratings_count }} Rating)

                     </option>

                     @endforeach

                  </select>

               </div>

            </div>

         </form>

      </div>

   </div>



   <div class="card mb-4">

      <div class="card-header">

         <h5 class="mb-0">

            Informasi Pengguna

         </h5>

      </div>

      <div class="card-body">

         <table class="table table-bordered mb-0">

            <tr>

               <th width="30%">Nama Pengguna</th>

               <td>{{ $user->name }}</td>

            </tr>

            <tr>

               <th>ID Pengguna</th>

               <td>{{ $user->id }}</td>

            </tr>

            <tr>

               <th>Role</th>

               <td>{{ $user->role }}</td>

            </tr>

            <tr>

               <th>Jumlah Produk</th>

               <td>{{ $totalProducts }}</td>

            </tr>

            <tr>

               <th>Jumlah Rating yang Diberikan</th>

               <td>{{ $totalRatings }}</td>

            </tr>

            <tr>

               <th>Produk Belum Dirating</th>

               <td>{{ $unratedProducts }}</td>

            </tr>

            <tr>

               <th>Jumlah Neighbor</th>

               <td>{{ $neighborCount }}</td>

            </tr>

            <tr>

               <th>Metode Rekomendasi</th>

               <td>User-Based Collaborative Filtering</td>

            </tr>

         </table>

      </div>

   </div>


   <div class="card">

      <div class="card-header">

         <h5 class="mb-0">

            Matriks Rating Pengguna

         </h5>

         <p class="text-muted mb-3">

            Matriks rating digunakan sebagai dasar pembentukan vektor pengguna
            untuk menghitung tingkat kemiripan menggunakan metode Cosine Similarity.

         </p>

         <div class="alert alert-light border">

            <h6 class="fw-bold mb-3">

               <i class="fas fa-palette text-primary"></i>

               Angka Rating

            </h6>

            <div class="row g-2">

               <div class="col-md-4 col-lg-2">
                  <div class="d-flex align-items-center">
                     <span class="badge rating-badge bg-success me-2">5</span>
                     <span>Sangat Suka</span>
                  </div>
               </div>

               <div class="col-md-4 col-lg-2">
                  <div class="d-flex align-items-center">
                     <span class="badge rating-badge bg-primary me-2">4</span>
                     <span>Suka</span>
                  </div>
               </div>

               <div class="col-md-4 col-lg-2">
                  <div class="d-flex align-items-center">
                     <span class="badge rating-badge bg-warning text-dark me-2">3</span>
                     <span>Cukup</span>
                  </div>
               </div>

               <div class="col-md-4 col-lg-2">
                  <div class="d-flex align-items-center">
                     <span class="badge rating-badge bg-danger me-2">2</span>
                     <span>Kurang</span>
                  </div>
               </div>

               <div class="col-md-4 col-lg-2">
                  <div class="d-flex align-items-center">
                     <span class="badge rating-badge bg-dark me-2">1</span>
                     <span>Tidak Suka</span>
                  </div>
               </div>

               <div class="col-md-4 col-lg-2">
                  <div class="d-flex align-items-center">
                     <span class="badge rating-badge bg-secondary me-2">—</span>
                     <span>Belum Dirating</span>
                  </div>
               </div>

            </div>

         </div>

      </div>

      <div class="card-body">

         <div class="matrix-table">

            <table class="table table-bordered table-sm align-middle mb-0">

               <table class="table table-bordered table-sm">

                  <thead>

                     <tr>

                        <th style="min-width:180px">

                           Pengguna

                        </th>
                        @foreach($products as $product)

                        <th title="{{ $product->product_name }}" data-bs-toggle="tooltip">

                           P{{ $product->id }}

                        </th>
                        @endforeach

                     </tr>

                  </thead>

                  <tbody>

                     @foreach($matrix as $uid => $ratings)

                     <tr class="{{ $uid == $userId ? 'table-primary fw-bold' : '' }}">

                        <td class="fw-semibold">

                           <span data-bs-toggle="tooltip" title="ID Pengguna : {{ $uid }}">

                              @if($uid == $userId)

                              <i class="fas fa-user-check text-primary me-1"></i>

                              @endif

                              {{ $userNames[$uid] }}

                           </span>

                        </td>

                        @foreach($products as $product)

                        <td class="text-center">

                           @php

                           $value = $ratings[$product->id];

                           $class = 'bg-secondary';

                           switch ($value) {

                           case 5:
                           $class = 'bg-success';
                           break;

                           case 4:
                           $class = 'bg-primary';
                           break;

                           case 3:
                           $class = 'bg-warning text-dark';
                           break;

                           case 2:
                           $class = 'bg-danger';
                           break;

                           case 1:
                           $class = 'bg-dark';
                           break;

                           }

                           @endphp

                           @if($value == 0)

                           <span class="badge rating-badge bg-secondary" data-bs-toggle="tooltip"
                              title="Produk: {{ $product->product_name }}&#10;Belum diberi rating">

                              —

                           </span>

                           @else

                           <span class="badge rating-badge {{ $class }}" data-bs-toggle="tooltip"
                              title="Produk: {{ $product->product_name }}&#10;Rating: {{ $value }}">

                              {{ $value }}

                           </span>

                           @endif

                        </td>

                        @endforeach

                     </tr>

                     @endforeach

                  </tbody>

               </table>
            </table>

         </div>

      </div>
   </div>

</div>

<div class="card mt-4">

   <div class="card-header">

      <h5 class="mb-0">

         Perhitungan Nilai Cosine Similarity

      </h5>

   </div>

   <div class="card-body">

      @forelse($similarities as $otherUser => $similarity)

      @php

      $percent = $similarity['similarity'] * 100;

      if($percent >= 95){
      $color = 'bg-success';
      }elseif($percent >= 80){
      $color = 'bg-primary';
      }elseif($percent >= 60){
      $color = 'bg-warning';
      }else{
      $color = 'bg-secondary';
      }

      @endphp

      <div class="mb-4">

         <div class="d-flex justify-content-between align-items-center">

            <div>

               <span class="badge bg-dark me-2">

                  #{{ $loop->iteration }}

               </span>

               <strong>

                  {{ $userNames[$otherUser] }}

               </strong>

            </div>

            <span class="badge bg-info">

               {{ number_format($similarity['similarity'],4) }}

            </span>

         </div>

         <div class="progress my-2" style="height:18px; max-width:350px;">

            <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $percent }}%;">

               {{ number_format($percent,1) }}%

            </div>

         </div>

         <small class="text-muted">

            <strong>Pengguna Utama :</strong>

            {{ $user->name }}

            &nbsp;&nbsp;|&nbsp;&nbsp;

            <strong>Pengguna Pembanding :</strong>

            {{ $userNames[$otherUser] }}

            &nbsp;&nbsp;|&nbsp;&nbsp;

            <strong>Co-Rated :</strong>

            {{ $similarity['coRated'] }} Produk

         </small>

      </div>

      @if(!$loop->last)
      <hr>
      @endif

      @empty

      <div class="alert alert-warning mb-0">

         Tidak terdapat pengguna pembanding yang memiliki nilai similarity.

      </div>

      @endforelse

   </div>

</div>

<div class="card mt-4">

   <div class="card-header">

      <h5 class="mb-0">

         Pengguna dengan Tingkat Kemiripan Tertinggi (Top-5 Neighbor)

      </h5>

   </div>

   <div class="card-body">

      @forelse($topNeighbors as $neighborId => $similarity)

      @php

      $percent = $similarity['similarity'] * 100;

      if($percent >= 95){
      $color = 'bg-success';
      }elseif($percent >= 80){
      $color = 'bg-primary';
      }elseif($percent >= 60){
      $color = 'bg-warning';
      }else{
      $color = 'bg-secondary';
      }

      @endphp

      <div class="mb-4">

         <div class="d-flex justify-content-between align-items-center">

            <div>

               @if($loop->iteration == 1)

               <span class="fs-5 me-2">🥇</span>

               @elseif($loop->iteration == 2)

               <span class="fs-5 me-2">🥈</span>

               @elseif($loop->iteration == 3)

               <span class="fs-5 me-2">🥉</span>

               @else

               <span class="badge bg-dark me-2">

                  #{{ $loop->iteration }}

               </span>

               @endif

               <strong>

                  {{ $userNames[$neighborId] }}

               </strong>

            </div>

            <div>

               <span class="badge bg-success">

                  Neighbor Terpilih

               </span>

               <span class="badge bg-primary ms-1">

                  {{ number_format($similarity['similarity'],4) }}

               </span>

            </div>

         </div>

         <div class="progress my-2" style="height:18px; max-width:350px;">

            <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $percent }}%;">

               {{ number_format($percent,1) }}%

            </div>

         </div>

         <small class="text-muted">

            <strong>Peringkat :</strong>

            #{{ $loop->iteration }}

            &nbsp;&nbsp;|&nbsp;&nbsp;

            <strong>Pengguna :</strong>

            {{ $userNames[$neighborId] }}

            &nbsp;&nbsp;|&nbsp;&nbsp;

            <strong>Status :</strong>

            Digunakan sebagai Neighbor

         </small>

      </div>

      @if(!$loop->last)
      <hr>
      @endif

      @empty

      <div class="alert alert-warning mb-0">

         Tidak terdapat neighbor yang memenuhi syarat.

      </div>

      @endforelse

   </div>

</div>

<div class="card mt-4">

   <div class="card-header">

      <h5>

         Hasil Prediksi Rating Produk

      </h5>

   </div>

   <div class="card-body">

      <table class="table table-bordered">

         <thead>

            <tr>

               <th>Peringkat</th>

               <th>Produk</th>

               <th>Kategori</th>

               <th>Nilai Prediksi Rating</th>

            </tr>

         </thead>

         <tbody>

            @foreach($predictions as $prediction)

            <tr>

               <td>{{ $loop->iteration }}</td>

               <td>

                  {{ $prediction['product']->product_name }}

               </td>

               <td>

                  {{ $prediction['product']->category->category_name }}

               </td>

               <td>

                  {{ number_format($prediction['score'],4) }}

               </td>

            </tr>

            @endforeach

         </tbody>

      </table>

   </div>

</div>

<div class="card mt-4">

   <div class="card-header">

      <h5 class="mb-0">

         Hasil Rekomendasi Produk

      </h5>

   </div>

   <div class="card-body">

      <div class="row">

         @foreach($recommendations as $item)

         <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

            <div class="card h-100 shadow-sm">

               <img src="{{ asset('storage/products/'.$item['product']->image) }}" class="card-img-top"
                  style="height:220px;object-fit:cover;">

               <div class="card-body">

                  <h6>

                     {{ $item['product']->product_name }}

                  </h6>

                  <small class="text-muted">

                     {{ $item['product']->category->category_name }}

                  </small>

                  <p class="mt-2 fw-bold text-primary">

                     Rp {{ number_format($item['product']->price,0,',','.') }}

                  </p>

                  <span class="badge bg-success">

                     Prediksi Rating
                     {{ number_format($item['score'],4) }}

                  </span>

               </div>

            </div>

         </div>

         @endforeach

      </div>

   </div>

</div>

</div>

@push('js')

<script>
document.addEventListener('DOMContentLoaded', function() {

   const tooltipTriggerList = [].slice.call(

      document.querySelectorAll('[data-bs-toggle="tooltip"]')

   );

   tooltipTriggerList.map(function(el) {

      return new bootstrap.Tooltip(el);

   });

});
</script>

@endpush

@push('css')

<style>
.matrix-table tbody tr:hover {

   background: #f8fafc;

}

.matrix-table tbody tr:hover td:first-child {

   background: #f1f5f9;

}

.rating-badge {

   width: 32px;

   height: 32px;

   display: inline-flex;

   align-items: center;

   justify-content: center;

   font-size: 14px;

   font-weight: bold;

   border-radius: 8px;

}

.matrix-table {

   max-height: 600px;

   overflow: auto;

}

.matrix-table table {

   white-space: nowrap;

}

.matrix-table thead th {

   position: sticky;

   top: 0;

   background: #ffffff;

   z-index: 3;

   text-align: center;

}

.matrix-table tbody td {

   text-align: center;

   vertical-align: middle;

}

.matrix-table tbody td:first-child,
.matrix-table thead th:first-child {

   position: sticky;

   left: 0;

   background: #ffffff;

   z-index: 4;

   min-width: 200px;

}

.rating-badge {

   width: 34px;

   height: 34px;

   display: inline-flex;

   align-items: center;

   justify-content: center;

   font-weight: 700;

   font-size: 14px;

   border-radius: 8px;

}

.table-primary td:first-child {

   background: #dbeafe !important;

}
</style>

@endpush

@endsection