{{-- resources/views/statuses/edit.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-6">Edit Status</h2>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('statuses.update', $status) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $status->nama) }}" required
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 font-medium">Tipe</label>
            <select name="tipe" id="tipeSelect" required class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="Selesai" {{ old('tipe', $status->tipe)=='Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Belum Dikerjakan" {{ old('tipe', $status->tipe)=='Belum Dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                <option value="Sedang Dikerjakan" {{ old('tipe', $status->tipe)=='Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Warna</label>
            <input type="color" name="color" id="colorInput" value="{{ old('color', $status->color) }}" required
                class="w-full border p-2 rounded h-12 cursor-pointer">
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Perbarui Status
        </button>
    </form>
</div>

<script>
// Auto set color based on tipe
document.getElementById('tipeSelect').addEventListener('change', function() {
    const colorInput = document.getElementById('colorInput');
    const tipe = this.value;
    
    if (tipe === 'Selesai') {
        colorInput.value = '#10B981'; // Hijau
    } else if (tipe === 'Belum Dikerjakan') {
        colorInput.value = '#EF4444'; // Merah
    } else if (tipe === 'Sedang Dikerjakan') {
        colorInput.value = '#F59E0B'; // Kuning/Orange
    }
});
</script>
@endsection