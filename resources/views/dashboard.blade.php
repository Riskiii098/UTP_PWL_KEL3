@extends('layouts.main')

@section('content')
<h1 class="text-3xl font-bold mb-8">Dashboard</h1>

{{-- Statistics Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Tugas --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Total Tugas</p>
                <h3 class="text-4xl font-bold">{{ $totalTugas }}</h3>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Tugas Selesai --}}
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-green-100 text-sm font-medium mb-1">Tugas Selesai</p>
                <h3 class="text-4xl font-bold">{{ $tugasSelesai }}</h3>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Sedang Dikerjakan --}}
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-yellow-100 text-sm font-medium mb-1">Sedang Dikerjakan</p>
                <h3 class="text-4xl font-bold">{{ $sedangDikerjakan }}</h3>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Melebihi Waktu --}}
    <div class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-red-100 text-sm font-medium mb-1">Melebihi Waktu</p>
                <h3 class="text-4xl font-bold">{{ $melebihiWaktu }}</h3>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- Two Column Layout --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Recent Tasks --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tugas Terbaru</h2>
        
        @if($recentTasks->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <p>Belum ada tugas. Mulai tambahkan tugas baru!</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tugas</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kategori</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Prioritas</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deadline</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentTasks as $task)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $task->title }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-gray-600">{{ $task->category->name ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-gray-600">{{ $task->priority->nama ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($task->status)
                                <span class="px-2 py-1 text-xs rounded text-white" style="background-color: {{ $task->status->color }}">
                                    {{ $task->status->tipe }}
                                </span>
                                @else
                                <span class="text-sm text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $task->deadline ? $task->deadline->format('d/m/Y') : '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Aksi Cepat</h2>
        
        <div class="space-y-3">
            <a href="{{ route('tasks.create') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-3 text-center font-medium transition">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tugas Baru
            </a>
            
            <a href="{{ route('categories.create') }}" class="block w-full bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg px-4 py-3 text-center font-medium transition">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                Kategori Baru
            </a>
            
            <a href="{{ route('priorities.create') }}" class="block w-full bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg px-4 py-3 text-center font-medium transition">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                </svg>
                Prioritas Baru
            </a>
            
            <a href="{{ route('statuses.create') }}" class="block w-full bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg px-4 py-3 text-center font-medium transition">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Status Baru
            </a>
        </div>
    </div>
</div>
@endsection