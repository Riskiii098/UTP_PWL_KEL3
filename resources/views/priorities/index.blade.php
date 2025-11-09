{{-- resources/views/priorities/index.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">Daftar Prioritas</h1>
    <a href="{{ route('priorities.create') }}" class="px-3 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">+ Tambah Prioritas</a>
</div>

@if($priorities->isEmpty())
    <div class="bg-white p-6 rounded shadow text-center text-gray-600">
        Belum ada prioritas. Tambahkan prioritas pertama Anda.
    </div>
@else
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Level</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Jumlah Tugas</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($priorities as $priority)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $priority->nama }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded text-sm">Level {{ $priority->level }}</span>
                    </td>
                    <td class="px-6 py-4">{{ $priority->tasks_count }} tugas</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('priorities.edit', $priority) }}" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200">Edit</a>
                            <form action="{{ route('priorities.destroy', $priority) }}" method="POST" onsubmit="return confirm('Hapus prioritas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">Hapus</button>
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