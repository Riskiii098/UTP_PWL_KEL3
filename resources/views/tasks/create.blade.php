{{-- resources/views/tasks/create.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Tambah Tugas</h2>
        <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:underline">Kembali</a>
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

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Deadline</label>
            <input type="date" name="deadline" value="{{ old('deadline') }}"
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="category_id" required class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Prioritas</label>
            <select name="priority_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Pilih Prioritas</option>
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                        {{ $priority->nama }} (Level {{ $priority->level }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Status</label>
            <select name="status_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Pilih Status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                        {{ $status->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Tambah Tugas
        </button>
    </form>
</div>
@endsection