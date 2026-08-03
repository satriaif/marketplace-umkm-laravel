@extends('adminlte::page')

@section('title', 'Tambah Kategori')

@section('content_header')
<h1>Tambah Kategori</h1>
@stop

@section('content')

<div class="card">
   <div class="card-body">

      <form action="{{ route('admin.categories.store') }}" method="POST">
         @csrf

         <div class="mb-3">
            <label class="form-label">Nama Kategori</label>

            <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" required>

            @error('category_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
         </div>

         <button class="btn btn-success">
            Simpan
         </button>

         <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            Kembali
         </a>

      </form>

   </div>
</div>

@stop