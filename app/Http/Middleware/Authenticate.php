<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Jika URL yang diakses diawali dengan 'mahasiswa/'...
            if ($request->is('mahasiswa/*')) {
                // ...arahkan ke halaman login mahasiswa.
                return route('mahasiswa.login');
            }

            // Jika tidak, arahkan ke halaman login default (untuk admin).
            return route('login');
        }
        return null;
    }
}