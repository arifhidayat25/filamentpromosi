<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class StudentLogin extends BaseLogin
{
    public function getHeading(): string|Htmlable
    {
        return 'Login Portal Student';
    }
}