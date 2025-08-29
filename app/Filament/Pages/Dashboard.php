<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\ProposalChart;
use App\Filament\Widgets\ProposalsByProdiChart;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            ProposalsByProdiChart::class,
            ProposalChart::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }
}
