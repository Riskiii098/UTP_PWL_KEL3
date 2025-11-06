@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold">Kelola Kategori</h1>
    <a href="{{ route('categories.create') }}" class="px-3 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">
        + Tambah Kategori
    </a>
</div>

@if($categories->isEmpty())
    <div class="bg-white p-6 rounded shadow text-center text-gray-600">
        Belum ada kategori. Tambah kategori baru.
    </div>
@else
    <div class="grid gap-4">
        @foreach($categories as $category)
            <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                <span class="text-gray-700 font-medium">{{ $category->name }}</span>
                <div class="flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
