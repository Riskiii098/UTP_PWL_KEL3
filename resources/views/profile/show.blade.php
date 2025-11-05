@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-xl p-6 animate__animated animate__fadeIn">
    <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Profil Saya</h2>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        <div>
            <label class="block text-gray-700 mb-1">Nama</label>
            <div class="border border-gray-300 rounded-lg p-2 bg-gray-100">{{ $user->name }}</div>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <div class="border border-gray-300 rounded-lg p-2 bg-gray-100">{{ $user->email }}</div>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Password</label>
            <div class="border border-gray-300 rounded-lg p-2 bg-gray-100">••••••</div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('profile.edit') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
