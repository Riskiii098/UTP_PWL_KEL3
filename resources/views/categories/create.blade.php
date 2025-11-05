@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Tambah Kategori</h2>
    <a href="{{ route('categories.index') }}" class="text-sm text-gray-600">Kembali</a>
  </div>

  @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4">
      <ul>
        @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label class="block mb-3">
      <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kategori" class="w-full border p-2 rounded" required>
    </label>

    <div class="flex gap-2">
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
      <a href="{{ route('categories.index') }}" class="px-4 py-2 border rounded">Batal</a>
    </div>
  </form>
</div>
@endsection
