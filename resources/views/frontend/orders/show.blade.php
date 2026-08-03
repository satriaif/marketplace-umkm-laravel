@extends('layouts.frontend')

@section('content')

<h2>Detail Pesanan #{{ $order->id }}</h2>

<div class="card mb-4">

   <div class="card-body">

      <h5>
         Status :
         <span class="badge bg-primary">
            {{ ucfirst($order->status) }}
         </span>
      </h5>

      <h5>
         Total :
         Rp {{ number_format($order->total_price,0,',','.') }}
      </h5>

   </div>

</div>

<table class="table table-bordered">

   <thead>

      <tr>

         <th>Produk</th>

         <th>Harga</th>

         <th>Jumlah</th>

         <th>Subtotal</th>

      </tr>

   </thead>


   <tbody>

      @foreach($order->items as $item)

      @if(!in_array($item->product_id, $ratedProducts))

      {{-- tampilkan form rating --}}

      @else
      <span class="badge bg-success">
         Sudah diberi rating
      </span>
      @endif

      @if($order->status == 'completed' && !in_array($item->product_id, $ratedProducts))


      <form action="{{ route('ratings.store', $item->product_id) }}" method="POST">

         @csrf

         <div class="mt-3">

            <label class="form-label">
               Berikan Rating
            </label>

            <select name="rating" class="form-select">

               @for($i = 5; $i >= 1; $i--)
               <option value="{{ $i }}">
                  {{ $i }} ⭐
               </option>
               @endfor

            </select>

         </div>

         <button class="btn btn-warning mt-2">

            Kirim Rating

         </button>



      </form>

      @endif
      <tr>

         <td>

            <div class="d-flex align-items-center">

               <img src="{{ asset('storage/products/'.$item->product->image) }}" width="80" class="me-3 rounded">

               <div>

                  <strong>

                     {{ $item->product->product_name }}

                  </strong>

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

      </tr>

      @endforeach

   </tbody>

</table>


@endsection