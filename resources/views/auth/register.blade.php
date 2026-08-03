@extends('layouts.auth')

@section('content')

<h3 class="text-center mb-4">
   Daftar
</h3>

@if ($errors->any())
<div class="alert alert-danger">

   <ul class="mb-0">

      @foreach ($errors->all() as $error)

      <li>{{ $error }}</li>

      @endforeach

   </ul>

</div>
@endif

<form method="POST" action="{{ route('register') }}">

   @csrf

   <div class="mb-3">

      <label>Nama</label>

      <input type="text" name="name" class="form-control" required>

   </div>

   <div class="mb-3">

      <label>Email</label>

      <input type="email" name="email" class="form-control" required>

   </div>

   <div class="mb-3">

      <label>Password</label>

      <input type="password" name="password" class="form-control" required>

   </div>

   <div class="mb-3">

      <label>Konfirmasi Password</label>

      <input type="password" name="password_confirmation" class="form-control" required>

   </div>

   <button class="btn btn-success w-100">

      Daftar

   </button>

</form>

<div class="text-center mt-3">

   Sudah punya akun?

   <a href="{{ route('login') }}">

      Login

   </a>

</div>

@endsection