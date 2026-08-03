@extends('adminlte::page')

@section('title', 'Kategori')

@section('content_header')
<h1>Data Kategori</h1>
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <h3 class="card-title">Daftar Kategori</h3>

      <div class="card-tools">
         <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            Tambah Kategori
         </a>
      </div>
   </div>

   <div class="card-body">

      <x-admin.table>
         <table class="table table-bordered table-striped admin-table">

            <thead>
               <tr>
                  <th width="70">ID</th>
                  <th>Nama Kategori</th>
                  <th width="180">Aksi</th>
               </tr>
            </thead>

            <tbody>

               @forelse($categories as $category)

               <tr>

                  <td>{{ $category->id }}</td>

                  <td>{{ $category->category_name }}</td>

                  <td>

                     <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                        Edit
                     </a>

                     <form id="delete-form-{{ $category->id }}"
                        action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                        style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $category->id }}">
                           Hapus
                        </button>

                     </form>

                  </td>

               </tr>

               @empty

               <tr>
                  <td colspan="3" class="text-center">
                     Belum ada data kategori.
                  </td>
               </tr>

               @endforelse

            </tbody>

         </table>

         <div class="mt-3">
            {{ $categories->links() }}
         </div>
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
         title: 'Hapus kategori?',
         text: "Data yang dihapus tidak dapat dikembalikan.",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         cancelButtonColor: '#6c757d',
         confirmButtonText: 'Ya, Hapus',
         cancelButtonText: 'Batal'
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
   timer: 2000,
   showConfirmButton: false,
   timerProgressBar: true
});
</script>
@endif
@stop