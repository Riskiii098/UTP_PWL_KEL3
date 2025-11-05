@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Edit Tugas</h2>
    <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600">Kembali</a>
  </div>

  @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')

    <label class="block mb-3">
      <span class="text-sm font-medium">Judul</span>
      <input type="text" name="title" value="{{ old('title', $task->title) }}" required class="w-full border p-2 mt-1 rounded">
    </label>

    <label class="block mb-3">
      <span class="text-sm font-medium">Deskripsi</span>
      <textarea name="description" rows="4" class="w-full border p-2 mt-1 rounded">{{ old('description', $task->description) }}</textarea>
    </label>

    <label class="block mb-3">
      <span class="text-sm font-medium">Kategori</span>
      <select name="category_id" required class="w-full border p-2 mt-1 rounded">
        @foreach($categories as $c)
          <option value="{{ $c->id }}" {{ (old('category_id', $task->category_id) == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
      </select>
    </label>

    <label class="inline-flex items-center gap-2 mb-3">
      <input type="checkbox" name="status" {{ old('status', $task->status) ? 'checked' : '' }}> <span class="text-sm">Selesai</span>
    </label>

    <label class="block mb-4">
      <span class="text-sm font-medium">Deadline</span>
      <input type="date" name="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}" class="w-full border p-2 mt-1 rounded">
    </label>

    <div class="flex gap-2">
      <button class="bg-green-600 text-white px-4 py-2 rounded">Perbarui</button>
      <a href="{{ route('tasks.index') }}" class="px-4 py-2 border rounded">Batal</a>
    </div>
  </form>
</div>
@endsection
