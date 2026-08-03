@extends('layouts.frontend')

@section('title', 'Pembayaran')

@section('content')

<div class="container py-5">

   <h2 class="fw-bold mb-4">
      💳 Pembayaran Pesanan
   </h2>

   <div class="row g-4">

      {{-- QRIS --}}
      <div class="col-lg-6">

         <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body text-center p-5">

               <h4 class="fw-bold mb-4">
                  Scan QRIS
               </h4>

               <img src="{{ asset('images/qris-dummy.png') }}" class="img-fluid mb-4" style="max-width:300px;">

               <p class="text-muted mb-0">
                  Silakan lakukan pembayaran menggunakan
                  Mobile Banking, DANA, OVO, GoPay,
                  ShopeePay, atau aplikasi lain yang
                  mendukung QRIS.
               </p>

            </div>

         </div>

      </div>

      {{-- Informasi Pesanan --}}
      <div class="col-lg-6">

         <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body p-4">

               <h4 class="fw-bold mb-4">
                  Informasi Pesanan
               </h4>

               <div class="alert alert-warning">

                  Status :
                  <strong>Menunggu Pembayaran</strong>

               </div>

               <table class="table table-borderless">

                  <tr>
                     <th width="40%">Nomor Pesanan</th>
                     <td>#{{ $order->id }}</td>
                  </tr>

                  <tr>
                     <th>Nama Penerima</th>
                     <td>{{ $order->recipient_name }}</td>
                  </tr>

                  <tr>
                     <th>Nomor HP</th>
                     <td>{{ $order->phone }}</td>
                  </tr>

                  <tr>
                     <th>Provinsi</th>
                     <td>{{ $order->province }}</td>
                  </tr>

                  <tr>
                     <th>Kota</th>
                     <td>{{ $order->city }}</td>
                  </tr>

                  <tr>
                     <th>Kode Pos</th>
                     <td>{{ $order->postal_code }}</td>
                  </tr>

                  <tr>
                     <th>Alamat</th>
                     <td>{{ $order->address }}</td>
                  </tr>

               </table>

               <hr>

               <div class="d-flex justify-content-between align-items-center mb-4">

                  <h5 class="mb-0">
                     Total Pembayaran
                  </h5>

                  <h3 class="text-success fw-bold mb-0">

                     Rp {{ number_format($order->total_price,0,',','.') }}

                  </h3>

               </div>

               <form id="paymentForm" action="{{ route('checkout.confirm', $order) }}" method="POST">

                  @csrf

                  <div class="form-check mb-4">

                     <input class="form-check-input" type="checkbox" id="paymentCheck">

                     <label class="form-check-label" for="paymentCheck">

                        Saya telah melakukan pembayaran menggunakan QRIS di atas.

                     </label>

                  </div>

                  <button type="button" id="confirmButton" class="btn btn-success btn-lg w-100" disabled>

                     <i class="bi bi-check-circle-fill me-2"></i>

                     Konfirmasi Pembayaran

                  </button>

               </form>

            </div>

         </div>

      </div>

   </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

   const checkbox = document.getElementById('paymentCheck');
   const button = document.getElementById('confirmButton');
   const form = document.getElementById('paymentForm');

   checkbox.addEventListener('change', function() {

      button.disabled = !this.checked;

   });

   button.addEventListener('click', function() {

      Swal.fire({

         title: 'Konfirmasi Pembayaran',

         text: 'Apakah Anda yakin telah menyelesaikan pembayaran menggunakan QRIS?',

         icon: 'question',

         showCancelButton: true,

         confirmButtonText: 'Ya, Sudah Bayar',

         cancelButtonText: 'Batal',

         confirmButtonColor: '#198754'

      }).then((result) => {

         if (result.isConfirmed) {

            form.submit();

         }

      });

   });

});
</script>

@endsection