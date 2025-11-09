@extends('layouts.main')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="text-center max-w-2xl mx-auto">
        {{-- Error Icon & Code --}}
        <div class="mb-8 animate__animated animate__bounceIn">
            <div class="inline-block p-6 bg-red-100 rounded-full mb-4">
                <svg class="w-24 h-24 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h1 class="text-9xl font-bold bg-gradient-to-r from-red-600 via-red-700 to-red-800 bg-clip-text text-transparent mb-4 animate__animated animate__pulse">500</h1>
        </div>

        {{-- Error Message --}}
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Kesalahan Server</h2>
            <p class="text-lg text-gray-600 mb-2">{{ $message ?? 'Terjadi kesalahan pada server. Tim kami telah diberitahu dan sedang memperbaikinya.' }}</p>
            <p class="text-sm text-gray-500">Silakan coba lagi dalam beberapa saat atau hubungi administrator jika masalah berlanjut.</p>
        </div>

        {{-- Error Details (Development Only) --}}
        @if(config('app.debug') && isset($exception))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 text-left">
            <h3 class="text-sm font-semibold text-red-800 mb-2">Detail Error (Development Mode):</h3>
            <div class="text-xs text-gray-700 space-y-1">
                @if($exception->getFile())
                    <p><strong>File:</strong> <span class="text-red-600">{{ $exception->getFile() }}</span></p>
                @endif
                @if($exception->getLine())
                    <p><strong>Line:</strong> <span class="text-red-600">{{ $exception->getLine() }}</span></p>
                @endif
                @if($exception->getMessage())
                    <p><strong>Message:</strong> <span class="text-red-600">{{ $exception->getMessage() }}</span></p>
                @endif
                @if(method_exists($exception, 'getTraceAsString'))
                    <details class="mt-2">
                        <summary class="cursor-pointer text-red-700 font-semibold hover:text-red-800">Stack Trace</summary>
                        <pre class="mt-2 p-2 bg-red-100 rounded text-xs overflow-auto max-h-48">{{ $exception->getTraceAsString() }}</pre>
                    </details>
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
            <button onclick="location.reload()" 
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-300 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Muat Ulang
            </button>
        </div>
    </div>
</div>
@endsection

