@extends('layouts.frontend')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

   <div>

      <h2 class="fw-bold">

         <i class="bi bi-bag-check-fill text-primary"></i>

         Pesanan Saya

      </h2>

      <p class="text-muted mb-0">

         Riwayat seluruh pesanan yang pernah Anda lakukan.

      </p>

   </div>

</div>

<div class="card border-0 shadow rounded-4">

   <div class="card-body p-0">

      <table class="table table-hover align-middle mb-0">

         <thead class="table-primary">
            <tr>

               <th width="12%">ID Pesanan</th>

               <th width="15%">Total Item</th>

               <th width="20%">Total Harga</th>

               <th width="18%">Status</th>

               <th width="15%" class="text-center">Detail</th>

            </tr>

         </thead>

         <tbody>

            @forelse($orders as $order)

            <tr>

               <td>

                  <strong>

                     #{{ $order->id }}

                  </strong>

                  <br>

                  <small class="text-muted">

                     {{ $order->created_at->format('d M Y') }}

                  </small>

               </td>


               <td>

                  {{ $order->items->sum('quantity') }} Item

               </td>

               <td>

                  <h6 class="fw-bold text-primary mb-0">

                     Rp {{ number_format($order->total_price,0,',','.') }}

                  </h6>

               </td>

               <td>

                  @php

                  $badge = match($order->status){

                  'completed' => 'success',

                  'shipped' => 'primary',

                  'processed' => 'warning',

                  'pending' => 'secondary',

                  'cancelled' => 'danger',

                  default => 'dark'

                  };

                  @endphp


                  <span class="badge bg-{{ $badge }}">

                     {{ ucfirst($order->status) }}

                  </span>

               </td>

               <td class="text-center">

                  <button class="btn btn-outline-primary rounded-pill btn-sm" data-bs-toggle="collapse"
                     data-bs-target="#detail{{ $order->id }}">

                     <i class="bi bi-eye"></i>

                     Detail

                  </button>

               </td>

            </tr>

            <tr>

               <td colspan="5" class="border-0 p-0">

                  <div class="collapse" id="detail{{ $order->id }}">

                     <div class="m-4">

                        <div class="card border-0 shadow-sm rounded-4">

                           <div class="card-header bg-white">

                              <div class="d-flex justify-content-between align-items-center">

                                 <strong>

                                    Detail Pesanan #{{ $order->id }}

                                 </strong>

                                 <span class="badge bg-primary">

                                    {{ $order->items->count() }} Produk

                                 </span>

                              </div>

                           </div>

                           <div class="card-body p-0">

                              <table class="table align-middle mb-0">
                                 <thead class="table-light">

                                    <tr>

                                       <th>Produk</th>

                                       <th>Harga</th>

                                       <th>Jumlah</th>

                                       <th>Subtotal</th>

                                       <th width="18%">Rating</th>

                                    </tr>

                                 </thead>

                                 <tbody>

                                    @foreach($order->items as $item)

                                    <tr>

                                       <td>

                                          <div class="d-flex align-items-center">

                                             <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                                alt="{{ $item->product->product_name }}"
                                                class="order-product-image me-3">

                                             <div>

                                                <div class="fw-bold">

                                                   {{ $item->product->product_name }}

                                                </div>

                                                <small class="text-muted">

                                                   {{ $item->product->category->category_name }}

                                                </small>

                                             </div>

                                          </div>

                                       </td>

                                       <td>

                                          Rp {{ number_format($item->price,0,',','.') }}

                                       </td>

                                       <td>

                                          {{ $item->quantity }}

                                       </td>

                                       <td>

                                          Rp {{ number_format($item->price * $item->quantity,0,',','.') }}

                                       </td>

                                       <td>

                                          @php

                                          $userRating = $item->product->ratings
                                          ->where('user_id', auth()->id())
                                          ->first();

                                          @endphp

                                          @if($order->status != 'completed')

                                          <span class="badge bg-secondary">

                                             Belum tersedia

                                          </span>

                                          @elseif($userRating)

                                          <div class="text-warning">

                                             @for($i=1;$i<=5;$i++) @if($i <=$userRating->rating)

                                                <i class="bi bi-star-fill"></i>

                                                @else

                                                <i class="bi bi-star"></i>

                                                @endif

                                                @endfor

                                          </div>

                                          <small class="text-muted">

                                             {{ $userRating->rating }}/5

                                          </small>

                                          @else

                                          <button class="btn btn-success btn-sm btn-rating" data-bs-toggle="modal"
                                             data-bs-target="#ratingModal"
                                             data-product="{{ $item->product->product_name }}"
                                             data-image="{{ asset('storage/products/'.$item->product->image) }}"
                                             data-action="{{ route('ratings.store',$item->product->id) }}">

                                             <i class="bi bi-star-fill"></i>
                                             Beri Rating
                                          </button>

                                          @endif

                                       </td>

                                    </tr>

                                    <!-- <div class="modal fade" id="ratingModal{{ $order->id }}_{{ $item->product->id }}"
                                       tabindex="-1">

                                       <div class="modal-dialog">

                                          <div class="modal-content">

                                             <form method="POST"
                                                action="{{ route('ratings.store',$item->product->id) }}">

                                                @csrf

                                                <div class="modal-header">

                                                   <h5 class="modal-title">

                                                      Beri Rating

                                                   </h5>

                                                   <button type="button" class="btn-close" data-bs-dismiss="modal">

                                                   </button>

                                                </div>

                                                <div class="modal-body">

                                                   <label class="form-label">

                                                      Pilih Rating

                                                   </label>

                                                   <select name="rating" class="form-select">

                                                      @for($i=5;$i>=1;$i--)

                                                      <option value="{{ $i }}">

                                                         {{ $i }} ★

                                                      </option>

                                                      @endfor

                                                   </select>

                                                </div>

                                                <div class="modal-footer">

                                                   <button class="btn btn-primary">

                                                      Simpan Rating

                                                   </button>

                                                </div>

                                             </form>

                                          </div>

                                       </div>

                                    </div> -->
                                    @endforeach

                                 </tbody>

                              </table>

                           </div>

                        </div>

                     </div>

                  </div>

               </td>

            </tr>

            @empty

            <div class="py-5">

               <i class="bi bi-bag-x display-1 text-secondary"></i>

               <h4 class="fw-bold mt-3">

                  Belum Ada Pesanan

               </h4>

               <p class="text-muted">

                  Mulai belanja untuk melihat riwayat pesanan Anda.

               </p>

               <a href="{{ route('home') }}" class="btn btn-primary rounded-pill">

                  Mulai Belanja

               </a>

            </div>

            @endforelse

         </tbody>

      </table>

   </div>

</div>

<div class="mt-4">

   {{ $orders->links() }}

</div>

<div class="modal fade" id="ratingModal" tabindex="-1">

   <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content border-0 shadow rounded-4">

         <form method="POST" id="ratingForm">

            @csrf

            <div class="modal-header border-0">

               <h5 class="modal-title fw-bold">

                  ⭐ Beri Penilaian Produk

               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>

            </div>

            <div class="modal-body">

               <div class="text-center mb-4">

                  <img id="ratingImage" class="rounded-3 border" style="width:120px;height:120px;object-fit:cover;">

                  <h5 id="ratingProduct" class="mt-3 fw-bold">
                  </h5>

               </div>

               <label class="form-label fw-semibold">

                  Rating

               </label>

               <select class="form-select" name="rating">

                  <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                  <option value="4">⭐⭐⭐⭐ Cukup Puas</option>
                  <option value="3">⭐⭐⭐ Biasa Saja</option>
                  <option value="2">⭐⭐ Kurang Puas</option>
                  <option value="1">⭐ Sangat Kecewa</option>

               </select>

            </div>

            <div class="modal-footer border-0">

               <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                  Batal

               </button>

               <button class="btn btn-primary px-4">

                  <i class="bi bi-send-fill me-1"></i>

                  Kirim Rating

               </button>

            </div>

         </form>

      </div>

   </div>

</div>


@section('js')

@if(session('payment_success'))
<script>
Swal.fire({
   icon: 'success',
   title: 'Pembayaran Berhasil',
   text: '{{ session("payment_success") }}',
   confirmButtonColor: '#198754'
});
</script>
@endif

@if(session('rating_success'))
<script>
Swal.fire({
   icon: 'success',
   title: 'Rating Berhasil',
   text: '{{ session("rating_success") }}',
   confirmButtonColor: '#0d6efd'
});
</script>
@endif

<script>
const ratingModal = document.getElementById('ratingModal');

ratingModal.addEventListener('show.bs.modal', function(event) {

   const button = event.relatedTarget;

   document.getElementById('ratingForm').action =
      button.dataset.action;

   document.getElementById('ratingProduct').innerHTML =
      button.dataset.product;

   document.getElementById('ratingImage').src =
      button.dataset.image;

});
</script>

@endsection
@endsection