@extends('adminlte::page')

@section('title', 'Data Pesanan')

@section('content_header')
<h1>Data Pesanan</h1>
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <h3 class="card-title">Daftar Pesanan</h3>
   </div>

   <div class="card-body">

      <x-admin.table>
         <table class="table table-bordered table-striped admin-table">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
               </tr>
            </thead>

            <tbody>
               @forelse($orders as $order)
               <tr>
                  <td>#{{ $order->id }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>Rp {{ number_format($order->total_price,0,',','.') }}</td>
                  <td>
                     @switch($order->status)
                     @case('pending')
                     <span class="badge bg-warning">Pending</span>
                     @break

                     @case('completed')
                     <span class="badge bg-success">Completed</span>
                     @break

                     @case('cancelled')
                     <span class="badge bg-danger">Cancelled</span>
                     @break

                     @default
                     <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                     @endswitch
                  </td>
                  <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                  <td class="text-center">
                     <div class="d-inline-flex align-items-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm"
                           style="margin-right:8px;">
                           <i class="fas fa-eye"></i>
                           Detail
                        </a>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                           class="d-inline m-0 delete-form">
                           @csrf
                           @method('DELETE')

                           <button type="button" class="btn btn-danger btn-sm btn-delete">
                              <i class="bi bi-trash"></i>
                              Hapus
                           </button>
                        </form>
                     </div>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="6" class="text-center">Belum ada pesanan.</td>
               </tr>
               @endforelse
            </tbody>
         </table>

         <div class="mt-3">
            {{ $orders->links() }}
         </div>
      </x-admin.table>

   </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.btn-delete').forEach(button => {
      button.addEventListener('click', function() {
         const form = this.closest('form');

         Swal.fire({
            title: 'Hapus Pesanan?',
            text: 'Data pesanan akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
         }).then((result) => {
            if (result.isConfirmed) {
               form.submit();
            }
         });
      });
   });
});
</script>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
   Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: @json(session('success'))
   });
});
</script>
@endif
@endsection