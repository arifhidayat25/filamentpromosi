<?php

namespace App\Filament\Student\Resources\ReportResource\Pages;

use App\Filament\Student\Resources\ReportResource;
use App\Models\Proposal;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    /**
     * Metode ini berjalan SEBELUM data laporan disimpan.
     * Ia akan menambahkan status 'diajukan' secara otomatis.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'diajukan';
        return $data;
    }

    /**
     * Metode ini berjalan SETELAH laporan berhasil dibuat.
     * Ia akan mengubah status proposal menjadi 'Menunggu Pembayaran'.
     */
    protected function afterCreate(): void
    {
        $proposal = Proposal::find($this->record->proposal_id);
        if ($proposal) {
            $proposal->update(['status' => 'Menunggu Pembayaran']);
        }
    }
}