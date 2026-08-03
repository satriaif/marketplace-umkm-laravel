@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard Admin</h1>
@stop

@section('content')

<div class="row">

   <div class="col-lg-3 col-6">
      <x-adminlte-small-box title="{{ $totalProducts }}" text="Total Produk" icon="fas fa-box" theme="primary" />
   </div>

   <div class="col-lg-3 col-6">
      <x-adminlte-small-box title="{{ $totalCategories }}" text="Total Kategori" icon="fas fa-list" theme="success" />
   </div>

   <div class="col-lg-3 col-6">
      <x-adminlte-small-box title="{{ $totalOrders }}" text="Total Pesanan" icon="fas fa-shopping-cart"
         theme="warning" />
   </div>

   <div class="col-lg-3 col-6">
      <x-adminlte-small-box title="{{ $totalUsers }}" text="Total User" icon="fas fa-users" theme="danger" />
   </div>

</div>

<div class="row mt-2">

   <div class="col-lg-6">
      <x-adminlte-small-box title="Rp {{ number_format($totalRevenue,0,',','.') }}" text="Total Pendapatan"
         icon="fas fa-money-bill-wave" theme="info" />
   </div>

   <div class="col-lg-6">
      <x-adminlte-small-box title="{{ $pendingOrders }}" text="Pesanan Pending" icon="fas fa-clock" theme="secondary" />
   </div>

</div>

@stop

@section('js')

@if(session('success'))
<script>
Swal.fire({
   icon: 'success',
   title: 'Berhasil',
   text: "{{ session('success') }}",
   timer: 1800,
   showConfirmButton: false
});
</script>
@endif

@stop