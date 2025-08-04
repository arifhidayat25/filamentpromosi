<?php

namespace App\Filament\Student\Resources\ReportResource\Pages;

use App\Filament\Student\Resources\ReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    /**
     * Metode ini akan berjalan sebelum laporan disimpan.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Memberi status default pada laporan yang baru dibuat
        $data['status'] = 'diajukan';
        return $data;
    }
}