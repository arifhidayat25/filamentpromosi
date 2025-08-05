<?php

namespace App\Filament\Auth;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class StudentLogin extends BaseLogin
{
    public function getHeading(): string|Htmlable
    {
        return 'Login Portal Student';
    }

    /**
     * PERBAIKAN: Mengubah visibility dari 'protected' menjadi 'public'
     * agar sesuai dengan parent class-nya.
     */
    public function authenticate(): ?LoginResponse
    {
        // Jalankan proses otentikasi bawaan Filament
        $response = parent::authenticate();

        // Jika otentikasi berhasil (user tidak null)...
        if (auth()->check()) {
            // ...atur "tanda" di session untuk menampilkan modal.
            session()->flash('show_welcome_modal', true);
        }

        return $response;
    }
}