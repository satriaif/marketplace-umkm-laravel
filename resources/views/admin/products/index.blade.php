@extends('adminlte::page')

@section('title', 'Produk')

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

@stop

@section('content_header')
<h1>Data Produk</h1>
@stop

@section('content')

<div class="card">

   <div class="card-header">

      <a href="{{ route('admin.products.create') }}" class="btn btn-primary">

         Tambah Produk

      </a>

   </div>

   <div class="card-body">

      <x-admin.table>
         <table class="table table-bordered admin-table">

            <thead>

               <tr>
                  <th>Foto Produk</th>

                  <th>ID</th>

                  <th>Nama Produk</th>

                  <th>Seller</th>

                  <th>Kategori</th>

                  <th>Harga</th>

                  <th>Stok</th>

                  <th>Aksi</th>

               </tr>

            </thead>

            <tbody>

               @forelse($products as $product)

               <tr>

                  <td>
                     @if($product->image)
                     <img src="{{ asset('storage/products/' . $product->image) }}" width="80" height="80"
                        style="object-fit:cover;border-radius:8px;">
                     @else
                     <span class="badge bg-secondary">Tidak ada gambar</span>
                     @endif
                  </td>

                  <td>{{ $product->id }}</td>

                  <td>{{ $product->product_name }}</td>

                  <td>{{ $product->seller->seller_name ?? '-' }}</td>

                  <td>{{ $product->category->category_name }}</td>

                  <td>
                     Rp {{ number_format($product->price,0,',','.') }}
                  </td>

                  <td>@if($product->stock > 0)
                     <span class="badge bg-success">
                        {{ $product->stock }}
                     </span>
                     @else
                     <span class="badge bg-danger">
                        Habis
                     </span>
                     @endif
                  </td>

                  <td>

                     <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-warning btn-sm">
                        Edit
                     </a>

                     <form id="delete-form-{{ $product->id }}"
                        action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                        style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $product->id }}">

                           Hapus

                        </button>

                     </form>

                  </td>

               </tr>

               @empty

               <tr>

                  <td colspan="6" class="text-center">
                     Belum ada produk
                  </td>

               </tr>

               @endforelse

            </tbody>

         </table>

      </x-admin.table>
   </div>

</div>

@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {

   button.addEventListener('click', function() {

      let id = this.dataset.id;

      Swal.fire({

         title: 'Hapus Produk?',

         text: 'Produk yang dihapus tidak dapat dikembalikan.',

         icon: 'warning',

         showCancelButton: true,

         confirmButtonText: 'Ya, Hapus',

         cancelButtonText: 'Batal',

         confirmButtonColor: '#d33'

      }).then((result) => {

         if (result.isConfirmed) {

            document.getElementById('delete-form-' + id).submit();

         }

      });

   });

});
</script>

@if(session('success'))

<script>
Swal.fire({

   icon: 'success',

   title: 'Berhasil',

   text: '{{ session("success") }}',

   timer: 1800,

   showConfirmButton: false,

   timerProgressBar: true

});
</script>

@endif

@stop