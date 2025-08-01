<?php

namespace App\Filament\Student\Resources\ProposalResource\Pages;

use App\Filament\Student\Resources\ProposalResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProposal extends CreateRecord
{
    protected static string $resource = ProposalResource::class;

    /**
     * Modifikasi data form sebelum disimpan ke database.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Secara otomatis mengisi user_id dengan ID mahasiswa yang login
        $data['user_id'] = Auth::id();
        // Menetapkan status awal pengajuan
        $data['status'] = 'diajukan';

        return $data;
    }

    /**
     * Mengarahkan kembali ke halaman daftar setelah berhasil membuat.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Menampilkan notifikasi setelah berhasil membuat data.
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Proposal Berhasil Diajukan')
            ->body('Proposal Anda telah berhasil dibuat dan menunggu persetujuan.');
    }
}