@extends('adminlte::page')

@section('title', 'Tambah Seller')

@section('content_header')
<h1>Tambah Seller</h1>
@stop

@section('content')

<div class="card">

   <div class="card-body">

      <form action="{{ route('admin.sellers.store') }}" method="POST">

         @csrf

         <div class="mb-3">

            <label>Nama Toko</label>

            <input type="text" name="seller_name" class="form-control" value="{{ old('seller_name') }}" required>

         </div>

         <div class="mb-3">

            <label>Nama Pemilik</label>

            <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}" required>

         </div>

         <div class="mb-3">

            <label>No. Telepon</label>

            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">

         </div>

         <div class="mb-3">

            <label>Alamat</label>

            <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>

         </div>

         <div class="mb-3">

            <label>Deskripsi</label>

            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>

         </div>

         <button class="btn btn-success">

            Simpan

         </button>

         <a href="{{ route('admin.sellers.index') }}" class="btn btn-secondary">

            Kembali

         </a>

      </form>

   </div>

</div>

@stop

@if(session('success'))

<script>
Swal.fire({

   icon: 'success',

   title: 'Berhasil',

   text: '{{ session("success") }}',

   timer: 1800,

   showConfirmButton: false

});
</script>

@endif