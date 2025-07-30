<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika pengguna yang sudah login memiliki role 'mahasiswa'...
                if (Auth::user()->role === 'mahasiswa') {
                    // ...arahkan ke dashboard mahasiswa.
                    return redirect(route('mahasiswa.dashboard'));
                }

                
            }
        }

        return $next($request);
    }
}
