@extends('layouts.main')
@section('content')
<div class="bg-white p-6 rounded shadow-md max-w-md mx-auto mt-10">
  <h2 class="text-2xl font-bold text-center mb-4">Login</h2>

  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
      <ul>
        @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('login.post') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full border p-2 mb-3 rounded" required>
    <input type="password" name="password" placeholder="Password" class="w-full border p-2 mb-3 rounded" required>
    <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
  </form>
  <p class="mt-3 text-center">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
</div>
@endsection
