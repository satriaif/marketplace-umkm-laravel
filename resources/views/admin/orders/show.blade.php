@extends('adminlte::page')

@section('title', 'Detail Pesanan')

@section('content_header')

<div class="card-header">
   <div class="d-flex justify-content-between align-items-center">

      <h1>Detail Pesanan #{{ $order->id }}</h1>

   </div>

   <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">

      <i class="fas fa-arrow-left"></i>

      Kembali

   </a>
</div>
@stop

@section('content')

<div class="row">

   <div class="col-md-4">

      <div class="card">

         <div class="card-header">
            <strong>Informasi Pesanan</strong>
         </div>

         <div class="card-body">

            <p>
               <strong>User :</strong><br>
               {{ $order->user->name }}
            </p>

            <p>
               <strong>Email :</strong><br>
               {{ $order->user->email }}
            </p>

            <p>
               <strong>Total :</strong><br>
               Rp {{ number_format($order->total_price,0,',','.') }}
            </p>

            <p>
            <div class="mt-4">

               <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">

                  @csrf
                  @method('PUT')

                  <label class="form-label">

                     Status

                  </label>

                  <select name="status" class="form-control">

                     <option value="pending" {{ $order->status=='pending'?'selected':'' }}>
                        Pending
                     </option>

                     <option value="paid" {{ $order->status=='paid'?'selected':'' }}>
                        Paid
                     </option>

                     <option value="processed" {{ $order->status=='processed'?'selected':'' }}>
                        Processed
                     </option>

                     <option value="shipped" {{ $order->status=='shipped'?'selected':'' }}>
                        Shipped
                     </option>

                     <option value="completed" {{ $order->status=='completed'?'selected':'' }}>
                        Completed
                     </option>

                     <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>
                        Cancelled
                     </option>

                  </select>

                  <button class="btn btn-success mt-3 w-100">

                     Update Status

                  </button>

               </form>

            </div>
            </p>

            <p>
               <strong>Tanggal :</strong><br>

               {{ $order->created_at->format('d M Y H:i') }}

            </p>

         </div>

      </div>

   </div>

   <div class="col-md-8">

      <div class="card">

         <div class="card-header">

            <strong>Daftar Produk</strong>

         </div>

         <div class="card-body">

            <table class="table table-bordered">

               <thead>

                  <tr>

                     <th>Produk</th>
                     <th>Harga</th>
                     <th>Qty</th>
                     <th>Subtotal</th>

                  </tr>

               </thead>

               <tbody>

                  @foreach($order->items as $item)

                  <tr>

                     <td>

                        <div class="d-flex align-items-center">

                           @if($item->product->image)
                           <img src="{{ asset('storage/products/'.$item->product->image) }}" width="70"
                              class="me-3 rounded">
                           @endif

                           {{ $item->product->product_name }}

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

                  </tr>

                  @endforeach

               </tbody>

            </table>

         </div>

      </div>

   </div>

</div>

@stop
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
   icon: 'success',
   title: 'Berhasil',
   text: '{{ session("success") }}',
   timer: 2000,
   showConfirmButton: false
});
</script>
@endif

@endsection