<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;

// Impor semua widget baru Anda
use App\Filament\Student\Widgets\PengajuanStatsOverview;
use App\Filament\Student\Widgets\ProposalTerbaru;
use App\Filament\Student\Widgets\PembayaranStats;

class Dashboard extends BaseDashboard
{
    /**
     * Mendaftarkan semua widget yang akan tampil di dashboard.
     */
    public function getWidgets(): array
    {
        return [
            PengajuanStatsOverview::class,
            PembayaranStats::class,
            ProposalTerbaru::class,
        ];
    }

    /**
     * Tombol Panduan Pengguna di pojok kanan atas.
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('panduan')
                ->label('Panduan Pengguna')
                ->icon('heroicon-o-question-mark-circle')
                ->modalHeading('Selamat Datang di Portal Mahasiswa!')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup')
                ->form([
                    Placeholder::make('langkah_1')
                        ->label('1. Buat Pengajuan Promosi')
                        ->content('Masuk ke menu "Pengajuan" untuk membuat proposal promosi baru ke sekolah yang Anda tuju.'),
                    Placeholder::make('langkah_2')
                        ->label('2. Lacak Status Anda')
                        ->content('Anda dapat melacak status pengajuan, laporan, dan pembayaran fee Anda melalui menu di navigasi.'),
                    Placeholder::make('langkah_3')
                        ->label('3. Cetak Sertifikat')
                        ->content('Setelah semua proses selesai dan pembayaran fee telah dilakukan, Anda dapat mengunduh sertifikat partisipasi dari halaman "Pengajuan".'),
                ]),
        ];
    }
}