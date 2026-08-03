@extends('adminlte::page')

@section('title', 'Data Rating')

@section('content_header')
<h1>Data Rating Produk</h1>
@stop

@section('content')

<div class="card">

   <div class="card-header">
      <h3 class="card-title">Daftar Rating</h3>
   </div>

   <div class="card-body">

      <x-admin.table>
         <table class="table table-bordered table-striped admin-table">

            <thead>

               <tr>
                  <th>No</th>
                  <th>User</th>
                  <th>Produk</th>
                  <th>Rating</th>
                  <th>Tanggal</th>
               </tr>

            </thead>

            <tbody>

               @forelse($ratings as $rating)

               <tr>

                  <td>{{ $loop->iteration + ($ratings->firstItem() - 1) }}</td>

                  <td>{{ $rating->user->name }}</td>

                  <td>{{ $rating->product->product_name }}</td>

                  <td>

                     @for($i = 1; $i <= 5; $i++) @if($i <=$rating->rating)
                        ⭐
                        @else
                        ☆
                        @endif
                        @endfor

                  </td>

                  <td>{{ $rating->created_at->format('d-m-Y H:i') }}</td>

               </tr>

               @empty

               <tr>

                  <td colspan="5" class="text-center">
                     Belum ada rating.
                  </td>

               </tr>

               @endforelse

            </tbody>

         </table>

         <div class="mt-3">
            {{ $ratings->links() }}
         </div>
      </x-admin.table>
   </div>

</div>

@stop