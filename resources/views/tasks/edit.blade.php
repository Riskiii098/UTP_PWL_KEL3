{{-- resources/views/tasks/edit.blade.php --}}
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
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id', $task->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Prioritas</label>
            <select name="priority_id" class="w-full border p-2 rounded">
                <option value="">Pilih Prioritas</option>
                @foreach ($priorities as $p)
                    <option value="{{ $p->id }}" {{ old('priority_id', $task->priority_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }} (Level {{ $p->level }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Status</label>
            <select name="status_id" class="w-full border p-2 rounded">
                <option value="">Pilih Status</option>
                @foreach ($statuses as $s)
                    <option value="{{ $s->id }}" {{ old('status_id', $task->status_id) == $s->id ? 'selected' : '' }}>
                        {{ $s->nama }}
                    </option>
                @endforeach
            </select>
        </div>

         <div class="mb-4">
    <label for="mood_id" class="block text-sm font-medium text-gray-700">Mood</label>
    <select name="mood_id" id="mood_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        <option value="">Pilih Mood</option>
        @foreach($moods as $mood)
            <option value="{{ $mood->id }}">{{ $mood->emoji }} {{ $mood->name }}</option>
        @endforeach
    </select>
</div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Perbarui Tugas
        </button>
    </form>
</div>
@endsection
