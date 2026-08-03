@extends('adminlte::page')

@section('title', 'Edit Kategori')

@section('content_header')
<h1>Edit Kategori</h1>
@stop

@section('content')

<div class="card">
   <div class="card-body">

      <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
         @csrf
         @method('PUT')

         <div class="mb-3">
            <label>Nama Kategori</label>

            <input type="text" name="category_name" class="form-control"
               value="{{ old('category_name', $category->category_name) }}" required>

            @error('category_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
         </div>

         <button class="btn btn-warning">
            Update
         </button>

         <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            Kembali
         </a>

      </form>

   </div>
</div>

@stop