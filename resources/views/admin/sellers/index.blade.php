@extends('adminlte::page')

@section('title', 'Seller')

@section('content_header')
<h1>Data Seller</h1>
@stop

@section('content')

<div class="card">

   <div class="card-header">

      <a href="{{ route('admin.sellers.create') }}" class="btn btn-primary">

         <i class="fas fa-plus"></i>

         Tambah Seller

      </a>

   </div>

   <div class="card-body">

      <table class="table table-bordered table-hover">

         <thead>

            <tr>

               <th width="50">No</th>

               <th>Nama Toko</th>

               <th>Pemilik</th>

               <th>Telepon</th>

               <th width="180">Aksi</th>

            </tr>

         </thead>

         <tbody>

            @forelse($sellers as $seller)

            <tr>

               <td>{{ $loop->iteration }}</td>

               <td>{{ $seller->seller_name }}</td>

               <td>{{ $seller->owner_name }}</td>

               <td>{{ $seller->phone }}</td>

               <td>

                  <a href="{{ route('admin.sellers.edit',$seller->id) }}" class="btn btn-warning btn-sm">

                     Edit

                  </a>

                  <form action="{{ route('admin.sellers.destroy',$seller->id) }}" method="POST" class="d-inline">

                     @csrf
                     @method('DELETE')

                     <button class="btn btn-danger btn-sm">

                        Hapus

                     </button>

                  </form>

               </td>

            </tr>

            @empty

            <tr>

               <td colspan="5" class="text-center">

                  Belum ada seller.

               </td>

            </tr>

            @endforelse

         </tbody>

      </table>

   </div>

</div>


@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
   icon: 'success',
   title: 'Berhasil',
   text: '{{ session("success") }}',
   timer: 2000,
   showConfirmButton: false
});
</script>
@endif

@endsection