<?php

namespace App\Providers\Filament;

use App\Filament\Auth\StudentLogin;
use App\Http\Middleware\StudentPanelAccessMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
use App\Filament\Auth\StudentRegistration;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Student\Pages\Dashboard;

class StudentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('student')
            ->path('student')
            ->colors(['primary' => Color::hex('#9542f5')])
            ->login(StudentLogin::class)
            ->profile()
            
            // --- PERUBAHAN DI SINI: Menambahkan Logo ---
            ->brandLogo(asset('image/ITSK.jpg'))
            ->brandLogoHeight('4rem')
            // -----------------------------------------

            ->discoverResources(in: app_path('Filament/Student/Resources'), for: 'App\\Filament\\Student\\Resources')
            ->discoverPages(in: app_path(path: 'Filament/Student/Pages'), for: 'App\\Filament\\Student\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Student/Widgets'), for: 'App\\Filament\\Student\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
                StudentPanelAccessMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
