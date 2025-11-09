@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-semibold mb-4">Edit Kategori</h2>

  @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4">
      <ul>
        @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block mb-1 font-medium">Nama Kategori</label>
      <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Nama kategori" class="w-full border p-2 rounded" required>
    </div>

    <div>
      <label class="block mb-1 font-medium">Deskripsi</label>
      <textarea name="deskripsi" rows="3" placeholder="Deskripsi kategori (opsional)" class="w-full border p-2 rounded">{{ old('deskripsi', $category->deskripsi) }}</textarea>
    </div>

    <div class="flex gap-2">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Perbarui</button>
      <a href="{{ route('categories.index') }}" class="px-4 py-2 border rounded">Batal</a>
    </div>
  </form>
</div>
@endsection