<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
// 1. Impor trait dan interface yang diperlukan
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;

// 2. Terapkan interface HasActions
class Dashboard extends BaseDashboard implements HasActions
{
    // 3. Gunakan trait InteractsWithActions
    use InteractsWithActions;

    public function booted(): void
    {
        if (session('show_welcome_modal')) {
            // Kode ini akan berfungsi karena 'showWelcomeModal'
            // adalah "Mounted Action" yang dikenali oleh komponen.
            $this->getAction('showWelcomeModal')->call();
        }
    }

    /**
     * Kita tidak menampilkan widget untuk saat ini.
     */
    public function getWidgets(): array
    {
        return [];
    }
    
    /**
     * Definisikan pop-up di sini sebagai "Mounted Action".
     * Ini adalah cara yang benar agar bisa dipanggil dari booted().
     */
    protected function getMountedActions(): array
    {
        return [
            Action::make('showWelcomeModal')
                ->label('Panduan Penggunaan')
                ->modalHeading('Selamat Datang di Portal Mahasiswa!')
                ->modalDescription('Berikut adalah panduan singkat untuk menggunakan portal ini:')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Saya Mengerti')
                ->form([
                    Placeholder::make('langkah_1')
                        ->label('1. Buat Pengajuan Promosi')
                        ->content('Masuk ke menu "Pengajuan" untuk membuat proposal promosi baru ke sekolah yang Anda tuju.'),

                    Placeholder::make('langkah_2')
                        ->label('2. Lacak Status')
                        ->content('Anda dapat melacak status pengajuan, laporan, dan pembayaran Anda melalui menu di samping.'),
                ])
                ->hidden(), // <-- Aksi ini ada tapi tombolnya disembunyikan
        ];
    }

    /**
     * Pastikan method getHeaderActions() kosong agar tidak bentrok.
     */
    protected function getHeaderActions(): array
    {
        return [];
    }
}