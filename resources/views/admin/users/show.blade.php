@extends('adminlte::page')

@section('title', 'Detail User')

@section('content')

<div class="card">

   <div class="card-header">

      <h3>Detail User</h3>

      <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">

         <i class="fas fa-arrow-left"></i>

         Kembali

      </a>

   </div>

   <div class="card-body">

      <p><strong>Nama</strong></p>

      <p>{{ $user->name }}</p>

      <hr>

      <p><strong>Email</strong></p>

      <p>{{ $user->email }}</p>

      <hr>

      <form action="{{ route('admin.users.update',$user->id) }}" method="POST">

         @csrf
         @method('PUT')

         <label>Role</label>

         <select name="role" class="form-control">

            <option value="user" {{ $user->role=='user'?'selected':'' }}>

               User

            </option>

            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>

               Admin

            </option>

         </select>

         <button class="btn btn-success mt-3">

            Update Role

         </button>

      </form>

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