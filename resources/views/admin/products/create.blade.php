@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
<h1>Tambah Produk</h1>
@stop

@section('content')

<div class="card">

   <div class="card-body">

      <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

         @csrf

         <div class="mb-3">

            <label>Nama Produk</label>

            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required>

         </div>

         <div class="mb-3">

            <label>Seller</label>

            <select name="seller_id" class="form-control" required>

               <option value="">
                  -- Pilih Seller --
               </option>

               @foreach($sellers as $seller)

               <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>

                  {{ $seller->seller_name }}

               </option>

               @endforeach

            </select>

         </div>

         <div class="mb-3">

            <label>Kategori</label>

            <select name="category_id" class="form-control" required>

               <option value="">-- Pilih Kategori --</option>

               @foreach($categories as $category)

               <option value="{{ $category->id }}">

                  {{ $category->category_name }}

               </option>

               @endforeach

            </select>

         </div>

         <div class="mb-3">

            <label>Harga</label>

            <input type="number" name="price" class="form-control" required>

         </div>

         <div class="mb-3">

            <label>Stok</label>

            <input type="number" name="stock" class="form-control" required>

         </div>

         <div class="mb-3">

            <label>Deskripsi</label>

            <textarea name="description" rows="5" class="form-control"></textarea>

         </div>

         <div class="mb-3">

            <label>Gambar Produk</label>

            <input type="file" name="image" class="form-control" id="image">

         </div>

         <div class="mb-3">

            <img id="preview" style="display:none;width:200px;" class="img-thumbnail">

         </div>

         <button class="btn btn-success">

            Simpan Produk

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

      document.getElementById('preview').src =
         reader.result;

      document.getElementById('preview').style.display =
         'block';

   }

   reader.readAsDataURL(e.target.files[0]);

}
</script>

@stop