@extends('layouts.main')
@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg mt-10 animate__animated animate__fadeInUp">
  <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">👤 Profil Pengguna</h2>

  <div class="space-y-4">
    <div>
      <p class="text-gray-600">Nama</p>
      <p class="text-lg font-semibold">{{ $user->name }}</p>
    </div>
    <div>
      <p class="text-gray-600">Email</p>
      <p class="text-lg font-semibold">{{ $user->email }}</p>
    </div>
  </div>

  <div class="mt-6 flex justify-between">
    <a href="{{ route('profile.edit') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300">
        Profile
    </a>
    <a href="{{ route('logout') }}" 
       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-300">
       Logout
    </a>
  </div>
</div>
@endsection
