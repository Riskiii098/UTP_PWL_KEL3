@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-semibold">Daftar Tugas</h1>
  <div class="flex gap-2">
    <a href="{{ route('categories.index') }}" class="px-3 py-2 bg-white text-gray-700 rounded shadow hover:bg-gray-50">Kelola Kategori</a>
    <a href="{{ route('tasks.create') }}" class="px-3 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">+ Tambah Tugas</a>
  </div>
</div>

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
          <div class="flex gap-3 text-sm text-gray-400 mt-3">
            <span>Deadline: {{ $task->deadline?->format('Y-m-d') ?? '-' }}</span>
            <span>|</span>
            <span>Kategori: {{ $task->category->name ?? '-' }}</span>
            <span>|</span>
            <span>Di buat: {{ $task->created_at->format('Y-m-d') }}</span>
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
