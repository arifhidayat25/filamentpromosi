<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('mahasiswa.login');
        }

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Loop melalui semua role yang diizinkan oleh rute
        foreach ($roles as $role) {
            // Jika role user cocok dengan salah satu role yang diizinkan,
            // izinkan akses.
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // Jika tidak ada role yang cocok, tolak akses.
        abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses yang sesuai.');
    }
}
