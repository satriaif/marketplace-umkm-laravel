@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content_header')
<h1>Edit Produk</h1>
@stop

@section('content')

<div class="card">
   <div class="card-body">

      <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

         @csrf
         @method('PUT')

         {{-- Nama Produk --}}
         <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="product_name" class="form-control"
               value="{{ old('product_name', $product->product_name) }}" required>

            @error('product_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
         </div>

         <div class="mb-3">

            <label>Seller</label>

            <select name="seller_id" class="form-control" required>

               @foreach($sellers as $seller)

               <option value="{{ $seller->id }}"
                  {{ old('seller_id', $product->seller_id) == $seller->id ? 'selected' : '' }}>

                  {{ $seller->seller_name }}

               </option>

               @endforeach

            </select>

         </div>

         {{-- Kategori --}}
         <div class="mb-3">
            <label class="form-label">Kategori</label>

            <select name="category_id" class="form-control" required>

               @foreach($categories as $category)

               <option value="{{ $category->id }}"
                  {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                  {{ $category->category_name }}

               </option>

               @endforeach

            </select>

            @error('category_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror

         </div>

         {{-- Harga --}}
         <div class="mb-3">
            <label class="form-label">Harga</label>

            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>

            @error('price')
            <small class="text-danger">{{ $message }}</small>
            @enderror

         </div>

         {{-- Stok --}}
         <div class="mb-3">
            <label class="form-label">Stok</label>

            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>

            @error('stock')
            <small class="text-danger">{{ $message }}</small>
            @enderror

         </div>

         {{-- Deskripsi --}}
         <div class="mb-3">
            <label class="form-label">Deskripsi</label>

            <textarea name="description" rows="5" class="form-control"
               required>{{ old('description', $product->description) }}</textarea>

            @error('description')
            <small class="text-danger">{{ $message }}</small>
            @enderror

         </div>

         {{-- Gambar Lama --}}
         @if($product->image)

         <div class="mb-3">

            <label class="form-label">Gambar Saat Ini</label>
            <br>

            <img src="{{ asset('storage/products/'.$product->image) }}" width="180" class="img-thumbnail">

         </div>

         @endif

         {{-- Upload Gambar Baru --}}
         <div class="mb-3">

            <label class="form-label">
               Ganti Gambar (Opsional)
            </label>

            <input type="file" name="image" class="form-control" id="image">

         </div>

         {{-- Preview --}}
         <div class="mb-3">

            <img id="preview" style="display:none;width:180px;" class="img-thumbnail">

         </div>

         <button class="btn btn-success">

            Update Produk

         </button>

         <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">

            Kembali

         </a>

      </form>

   </div>
</div>

@stop

@section('js')

<script>
document.getElementById('image').onchange = function(e) {

   let reader = new FileReader();

   reader.onload = function() {

      document.getElementById('preview').src = reader.result;

      document.getElementById('preview').style.display = 'block';

   }

   reader.readAsDataURL(e.target.files[0]);

}
</script>

@stop