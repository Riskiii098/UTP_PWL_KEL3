@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">Daftar Tugas</h1>
    <div class="flex gap-2">
        <a href="{{ route('categories.index') }}" class="px-3 py-2 bg-white text-gray-700 rounded shadow hover:bg-gray-50">Kelola Kategori</a>
        <a href="{{ route('tasks.create') }}" class="px-3 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">+ Tambah Tugas</a>
    </div>
</div>

{{-- Form Filter & Sort --}}
<form method="GET" class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-4 items-end">
    <div>
        <label class="block text-sm font-medium">Kategori</label>
        <select name="category_id" class="border p-2 rounded">
            <option value="">Semua</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Status</label>
        <select name="status" class="border p-2 rounded">
            <option value="">Semua</option>
            <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="belum" {{ request('status')=='belum' ? 'selected' : '' }}>Belum</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Prioritas</label>
        <select name="priority" class="border p-2 rounded">
            <option value="">Semua</option>
            <option value="tinggi" {{ request('priority')=='tinggi' ? 'selected' : '' }}>Tinggi</option>
            <option value="sedang" {{ request('priority')=='sedang' ? 'selected' : '' }}>Sedang</option>
            <option value="rendah" {{ request('priority')=='rendah' ? 'selected' : '' }}>Rendah</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Urutkan</label>
        <select name="sort" class="border p-2 rounded">
            <option value="deadline" {{ request('sort')=='deadline' ? 'selected' : '' }}>Deadline</option>
            <option value="priority" {{ request('sort')=='priority' ? 'selected' : '' }}>Prioritas</option>
            <option value="title" {{ request('sort')=='title' ? 'selected' : '' }}>Judul</option>
        </select>
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
        <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Reset</a>
    </div>
</form>

@if($tasks->isEmpty())
    <div class="bg-white p-6 rounded shadow text-center text-gray-600">
        Belum ada tugas. Tambah tugas pertama Anda.
    </div>
@else
    <div class="grid gap-4">
        @foreach($tasks as $task)
            <div class="bg-white p-4 rounded shadow flex justify-between items-start">
                <div class="pr-4">
                    <h2 class="text-lg font-semibold {{ $task->status ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $task->description }}</p>
                    <div class="flex gap-3 text-sm text-gray-400 mt-3 flex-wrap">
                        <span>Deadline: {{ $task->deadline?->format('Y-m-d') ?? '-' }}</span>
                        <span>|</span>
                        <span>Kategori: {{ $task->category->name ?? '-' }}</span>
                        <span>|</span>
                        <span>Prioritas: {{ ucfirst($task->priority) }}</span>
                        <span>|</span>
                        <span>Status: {{ $task->status ? 'Selesai' : 'Belum' }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?');">
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
