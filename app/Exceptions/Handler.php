<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Helpers\ResponseFormatter; // <-- 1. IMPORT FORMATTER ANDA
use Illuminate\Http\Exceptions\ThrottleRequestsException; // <-- 2. IMPORT EXCEPTION THROTTLING

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });

        // --- TAMBAHKAN BLOK KODE INI ---
        // Blok ini akan menangani bagaimana error ditampilkan (dirender).
       $this->renderable(function (ThrottleRequestsException $e, $request) {
            if ($request->expectsJson()) {
                // Menggunakan 'error' untuk throttling
                return ResponseFormatter::error(
                    null,
                    'Terlalu banyak percobaan. Silakan coba lagi nanti.',
                    429
                );
            }
        });
    }
}