<?php

namespace App\Filament\Student\Widgets;

use App\Models\Proposal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PengajuanStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        return [
            Stat::make('Total Pengajuan', Proposal::where('user_id', $user->id)->count())
                ->description('Semua proposal yang pernah dibuat')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),
            Stat::make('Disetujui', Proposal::where('user_id', $user->id)->whereIn('status', ['disetujui_pembina', 'disetujui_staf', 'laporan_disubmit', 'laporan_diverifikasi', 'selesai'])->count())
                ->description('Pengajuan yang lolos seleksi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Ditolak', Proposal::where('user_id', $user->id)->whereIn('status', ['ditolak_pembina', 'ditolak_staf'])->count())
                ->description('Pengajuan yang tidak disetujui')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}