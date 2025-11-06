@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Edit Tugas</h2>
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

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Deadline</label>
            <input type="date" name="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="category_id" required class="w-full border p-2 rounded">
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id', $task->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Prioritas</label>
            <select name="priority" required class="w-full border p-2 rounded">
                <option value="rendah" {{ old('priority', $task->priority) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                <option value="sedang" {{ old('priority', $task->priority) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="tinggi" {{ old('priority', $task->priority) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="status" {{ old('status', $task->status) ? 'checked' : '' }}>
            <label class="text-sm font-medium">Selesai</label>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Perbarui Tugas
        </button>
    </form>
</div>
@endsection
