@extends('layouts.main')

@section('content')
<div class="text-center mt-20">
    <h1 class="text-6xl font-bold text-gray-800">500</h1>
    <p class="text-xl text-gray-600 mt-4">Terjadi kesalahan server. Silakan coba lagi nanti.</p>
    <a href="{{ route('tasks.index') }}" class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Kembali ke Beranda
    </a>
</div>
@endsection
