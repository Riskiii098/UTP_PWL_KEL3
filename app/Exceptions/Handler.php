<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use InvalidArgumentException;
use Illuminate\Database\QueryException;
use PDOException;
use ParseError;
use Error;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        // ParseError / Syntax Error → tampilkan 500
        if ($exception instanceof ParseError || $exception instanceof Error) {
            return response()->view('errors.500', [
                'message' => 'Terjadi kesalahan syntax pada kode. Silakan periksa kembali kode aplikasi.',
                'exception' => $exception
            ], 500);
        }

        // QueryException / Database Connection Error → tampilkan 500
        if ($exception instanceof QueryException || $exception instanceof PDOException) {
            return response()->view('errors.500', [
                'message' => 'Terjadi kesalahan koneksi database. Pastikan server database sedang berjalan.',
                'exception' => $exception
            ], 500);
        }

        // InvalidArgumentException untuk view not found → tampilkan 404
        if ($exception instanceof InvalidArgumentException && str_contains($exception->getMessage(), 'View') && str_contains($exception->getMessage(), 'not found')) {
            return response()->view('errors.404', [
                'message' => 'Halaman yang Anda cari tidak ditemukan. View tidak tersedia.',
                'exception' => $exception
            ], 404);
        }

        // ModelNotFoundException → tampilkan 404
        if ($exception instanceof ModelNotFoundException) {
            return response()->view('errors.404', [
                'message' => 'Halaman atau data yang Anda cari tidak ditemukan.',
                'exception' => $exception
            ], 404);
        }

        // HttpException khusus (403, 404, 500, dll)
        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
            if (view()->exists("errors.{$status}")) {
                return response()->view("errors.{$status}", [
                    'message' => $exception->getMessage() ?: $this->getDefaultMessage($status),
                    'exception' => $exception
                ], $status);
            }
        }

        // Untuk error umum lainnya (500, dll)
        if ($this->isHttpException($exception)) {
            $status = $exception->getStatusCode();
            if (view()->exists("errors.{$status}")) {
                return response()->view("errors.{$status}", [
                    'message' => $exception->getMessage() ?: $this->getDefaultMessage($status),
                    'exception' => $exception
                ], $status);
            }
        }

        // Untuk error umum (500) - jika bukan HttpException tapi ada error
        // Hanya tampilkan custom 500 di production, di development tetap tampilkan error detail
        if (!config('app.debug')) {
            return response()->view('errors.500', [
                'message' => 'Terjadi kesalahan server. Silakan coba lagi nanti.',
                'exception' => $exception
            ], 500);
        }

        // Fallback default (di development akan tampilkan error detail)
        return parent::render($request, $exception);
    }

    /**
     * Get default error message based on status code
     */
    private function getDefaultMessage($status)
    {
        $messages = [
            400 => 'Permintaan tidak valid.',
            401 => 'Anda harus login terlebih dahulu.',
            403 => 'Akses ditolak. Anda tidak memiliki izin untuk membuka halaman ini.',
            404 => 'Halaman tidak ditemukan.',
            419 => 'Sesi Anda telah kedaluwarsa. Silakan refresh halaman.',
            429 => 'Terlalu banyak permintaan. Silakan coba lagi nanti.',
            500 => 'Terjadi kesalahan server. Silakan coba lagi nanti.',
            503 => 'Layanan sedang tidak tersedia. Silakan coba lagi nanti.',
        ];

        return $messages[$status] ?? 'Terjadi kesalahan.';
    }
}
