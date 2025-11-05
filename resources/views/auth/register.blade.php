@extends('layouts.main')

@section('content')
<div class="bg-white p-6 rounded shadow-md max-w-md mx-auto mt-10">
  <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

  {{-- ✅ Tampilkan pesan error jika validasi gagal --}}
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- ✅ Tampilkan pesan sukses jika register berhasil --}}
  @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ url('/register') }}" method="POST">
    @csrf
    <input 
      type="text" 
      name="name" 
      placeholder="Nama Lengkap" 
      value="{{ old('name') }}"
      class="w-full border p-2 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-400" 
      required>

    <input 
      type="email" 
      name="email" 
      placeholder="Email" 
      value="{{ old('email') }}"
      class="w-full border p-2 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-400" 
      required>

    <input 
      type="password" 
      name="password" 
      placeholder="Password (min. 6 karakter)" 
      class="w-full border p-2 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-400" 
      required>

    <button 
      type="submit"
      class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold p-2 rounded transition duration-200">
      Register
    </button>
  </form>

  <p class="mt-4 text-center text-sm">
    Sudah punya akun?
    <a href="{{ url('/login') }}" class="text-blue-500 hover:underline">Login di sini</a>
  </p>
</div>
@endsection
