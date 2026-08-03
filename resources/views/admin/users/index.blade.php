@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
<h1>Data User</h1>
@stop

@section('content')

<div class="card">

   <div class="card-header">
      <h3 class="card-title">Daftar User</h3>
   </div>

   <div class="card-body">

      <x-admin.table>
         <table class="table table-bordered table-striped admin-table">

            <thead>

               <tr>
                  <th width="70">ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th width="100">Role</th>
                  <th width="120">Aksi</th>
               </tr>

            </thead>

            <tbody>

               @forelse($users as $user)

               <tr>

                  <td>{{ $user->id }}</td>

                  <td>{{ $user->name }}</td>

                  <td>{{ $user->email }}</td>

                  <td>

                     @if($user->role == 'admin')

                     <span class="badge bg-danger">
                        Admin
                     </span>

                     @else

                     <span class="badge bg-primary">
                        User
                     </span>

                     @endif

                  </td>

                  <td>

                     <a href="{{ route('admin.users.show',$user) }}" class="btn btn-info btn-sm">

                        <i class="fas fa-eye"></i>

                        Detail

                     </a>

                  </td>

               </tr>

               @empty

               <tr>

                  <td colspan="5" class="text-center">
                     Belum ada data user.
                  </td>

               </tr>

               @endforelse

            </tbody>

         </table>

         <div class="mt-3">
            {{ $users->links() }}
         </div>
      </x-admin.table>
   </div>

</div>

@stop