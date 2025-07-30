<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Filament\Resources\ProposalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProposal extends CreateRecord
{
    protected static string $resource = ProposalResource::class;

    // KUNCI: Metode ini akan berjalan sebelum data disimpan ke database
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika yang membuat BUKAN admin (misal: mahasiswa),
        // otomatis set user_id dengan id user yang sedang login.
        if (!auth()->user()->hasRole('admin')) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }
}