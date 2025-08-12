<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\AdminPanelAccessMiddleware;
use App\Filament\Auth\AdminLogin;
use App\Models\User;
use Filament\Support\Facades\FilamentView; // <-- Tambahkan ini
use Illuminate\Support\Facades\Blade;     // <-- Tambahkan ini

class AdminPanelProvider extends PanelProvider
{
    /**
     * Metode ini dijalankan saat provider di-boot.
     * Kita gunakan untuk mendaftarkan aset eksternal seperti Google Fonts.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.end',
            fn (): string => Blade::render('<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />'),
        );
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(AdminLogin::class)
            
            // ==========================================================
            // == KUSTOMISASI VISUAL PANEL ==
            // ==========================================================
            
            // 1. Mengganti skema warna utama
            ->colors(['primary' => Color::hex('#19532bff')])

            // 2. Menambahkan Logo Institusi dari folder public/image/
            ->brandLogo(asset('image/ITSK.jpg')) 
            ->brandLogoHeight('4rem')

            // 3. Menggunakan Font "Poppins" yang sudah diimpor di atas
            ->font('Poppins')

            // 4. Mengaktifkan pilihan Dark Mode
            ->darkMode(true)
            
            // ==========================================================
            
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                AdminPanelAccessMiddleware::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                
                // --- PERBAIKAN UTAMA UNTUK "LOGIN AS" ---
                \DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin::make()
                    ->enabled(app()->environment('local'))
                    // Mengambil semua user, mengabaikan Global Scopes apa pun.
                    ->users(fn () => User::withoutGlobalScopes()->get()->pluck('email', 'name')->toArray()),

                \Rmsramos\Activitylog\ActivitylogPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
