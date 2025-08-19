<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class ManageApiTokens extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static string $view = 'filament.student.pages.manage-api-tokens';
    protected static ?string $navigationGroup = 'Akun Saya';
    protected static ?string $title = 'API Tokens';

    public ?string $tokenName = '';
    public $tokens;
    // public ?string $newToken = null; // <-- Properti ini tidak kita perlukan lagi

    public function mount(): void
    {
        $this->tokens = Auth::user()->tokens;
    }

    public function createToken()
    {
        $this->validate([
            'tokenName' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $newTokenPlainText = $user->createToken($this->tokenName)->plainTextToken;
        
        // --- PERUBAHAN UTAMA ADA DI SINI ---
        // Kita mengirim event 'token-created' ke browser dengan membawa data token.
        $this->dispatch('token-created', token: $newTokenPlainText);
        
        $this->tokenName = '';
        $this->tokens = $user->fresh()->tokens;

        Notification::make()
            ->title('API Token berhasil dibuat!')
            ->success()
            ->send();
    }

    public function deleteToken(int $tokenId)
    {
        $user = Auth::user();
        $user->tokens()->where('id', $tokenId)->delete();
        $this->tokens = $user->fresh()->tokens;

        Notification::make()
            ->title('API Token berhasil dihapus')
            ->warning()
            ->send();
    }
}