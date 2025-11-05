@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-xl p-6 animate__animated animate__fadeIn">
    <h2 class="text-2xl font-bold text-blue-600 mb-4 text-center">Edit Profile</h2>

    @if ($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-gray-700 mb-2">Nama</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name', $user->name) }}" 
                class="w-full border border-blue-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="Masukkan nama lengkap" required>
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-gray-700 mb-1">Email Saat Ini</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" value="{{ $user->email }}" disabled>

            <label for="email" class="block text-gray-700 mt-2 mb-2">Email Baru</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email', $user->email) }}" 
                class="w-full border border-blue-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="email@contoh.com" required>
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-gray-700 mb-1">Password Saat Ini</label>
            <input type="password" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" value="••••••" disabled>

            <label for="password" class="block text-gray-700 mt-2 mb-2">Password Baru <span class="text-sm text-gray-400">(opsional)</span></label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="w-full border border-blue-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="Biarkan kosong jika tidak ingin mengubah">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('profile.show') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
               Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
