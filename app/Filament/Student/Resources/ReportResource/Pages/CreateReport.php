<?php

namespace App\Filament\Student\Resources\ReportResource\Pages;

use App\Filament\Student\Resources\ReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    /**
     * Metode ini berjalan SEBELUM data laporan disimpan.
     * Hanya mengatur status laporan, tidak mengubah status proposal.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'diajukan';
        return $data;
    }
}