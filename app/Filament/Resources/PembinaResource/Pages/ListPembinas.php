<?php

namespace App\Filament\Resources\PembinaResource\Pages;

use App\Filament\Resources\PembinaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembinas extends ListRecords
{
    protected static string $resource = PembinaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
