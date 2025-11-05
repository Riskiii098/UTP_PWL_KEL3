@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-semibold">Kategori</h1>
  <div>
    <a href="{{ route('tasks.index') }}" class="px-3 py-2 bg-white text-gray-700 rounded shadow hover:bg-gray-50 mr-2">Back to Tasks</a>
    <a href="{{ route('categories.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ Tambah Kategori</a>
  </div>
</div>

@if($categories->isEmpty())
  <div class="bg-white p-6 rounded shadow text-center text-gray-600">
    Belum ada kategori. Tambah kategori baru.
  </div>
@else
  <div class="bg-white p-4 rounded shadow">
    <ul class="divide-y">
      @foreach($categories as $c)
        <li class="py-3 flex justify-between items-center">
          <span class="text-gray-800">{{ $c->name }}</span>
          <div class="flex gap-2">
            <a href="{{ route('categories.edit', $c) }}" class="px-3 py-1 border rounded text-sm">Edit</a>
            <form action="{{ route('categories.destroy', $c) }}" method="POST" onsubmit="return confirm('Hapus kategori?');">
              @csrf @method('DELETE')
              <button class="px-3 py-1 border rounded text-sm text-red-600">Hapus</button>
            </form>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
@endif
@endsection
