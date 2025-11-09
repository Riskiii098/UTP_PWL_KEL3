@extends('layouts.main')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="text-center max-w-2xl mx-auto">
        {{-- Error Icon & Code --}}
        <div class="mb-8 animate__animated animate__bounceIn">
            <div class="inline-block p-6 bg-blue-100 rounded-full mb-4">
                <svg class="w-24 h-24 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-9xl font-bold bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 bg-clip-text text-transparent mb-4 animate__animated animate__pulse">404</h1>
        </div>

        {{-- Error Message --}}
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-lg text-gray-600 mb-2">{{ $message ?? 'Halaman yang Anda cari tidak ditemukan atau telah dipindahkan.' }}</p>
            <p class="text-sm text-gray-500">Silakan periksa kembali URL yang Anda masukkan.</p>
        </div>

        {{-- Error Details (Development Only) --}}
        @if(config('app.debug') && isset($exception))
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-left">
            <h3 class="text-sm font-semibold text-blue-800 mb-2">Detail Error (Development Mode):</h3>
            <div class="text-xs text-gray-700 space-y-1">
                @if($exception->getFile())
                    <p><strong>File:</strong> <span class="text-blue-600">{{ $exception->getFile() }}</span></p>
                @endif
                @if($exception->getLine())
                    <p><strong>Line:</strong> <span class="text-blue-600">{{ $exception->getLine() }}</span></p>
                @endif
                @if($exception->getMessage())
                    <p><strong>Message:</strong> <span class="text-blue-600">{{ $exception->getMessage() }}</span></p>
                @endif
            </div>
        </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('tasks.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Kembali ke Beranda
            </a>
            <button onclick="window.history.back()" 
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-300 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </button>
        </div>
    </div>
</div>
@endsection
