@extends('layouts.auth')

@section('content')

<h3 class="text-center mb-4">
   Login
</h3>

<form method="POST" action="{{ route('login') }}">

   @csrf

   <div class="mb-3">

      <label>Email</label>

      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>

   </div>

   <div class="mb-3">

      <label>Password</label>

      <input type="password" name="password" class="form-control" required>

   </div>

   <div class="form-check mb-3">

      <input type="checkbox" name="remember" class="form-check-input">

      <label class="form-check-label">

         Ingat Saya

      </label>

   </div>

   <button class="btn btn-primary w-100">

      Login

   </button>

</form>

<div class="text-center mt-3">

   Belum punya akun?

   <a href="{{ route('register') }}">

      Daftar

   </a>

</div>

@endsection