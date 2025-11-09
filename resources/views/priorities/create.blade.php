{{-- resources/views/priorities/create.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-6">Tambah Prioritas</h2>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('priorities.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 font-medium">Level (1-5)</label>
            <select name="level" required class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="1" {{ old('level')=='1' ? 'selected' : '' }}>Level 1</option>
                <option value="2" {{ old('level')=='2' ? 'selected' : '' }}>Level 2</option>
                <option value="3" {{ old('level')=='3' ? 'selected' : '' }}>Level 3</option>
                <option value="4" {{ old('level')=='4' ? 'selected' : '' }}>Level 4</option>
                <option value="5" {{ old('level')=='5' ? 'selected' : '' }}>Level 5</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Tambah Prioritas
        </button>
    </form>
</div>
@endsection