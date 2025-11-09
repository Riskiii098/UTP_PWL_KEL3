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
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Jumlah Tugas</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $category->deskripsi ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $category->tasks_count }} tugas</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('categories.edit', $category) }}" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection