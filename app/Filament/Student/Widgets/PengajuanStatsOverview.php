<?php

namespace App\Filament\Student\Widgets;

use App\Models\Proposal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PengajuanStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();
        $cacheKeyPrefix = 'stats:pengajuan:' . $user->id; // <-- 2. Buat kunci cache yang unik per user

        // Cache data selama 15 menit
        $totalPengajuan = Cache::remember($cacheKeyPrefix . ':total', now()->addMinutes(15), function () use ($user) {
            return Proposal::where('user_id', $user->id)->count();
        });

        $totalDisetujui = Cache::remember($cacheKeyPrefix . ':disetujui', now()->addMinutes(15), function () use ($user) {
            return Proposal::where('user_id', $user->id)->whereIn('status', ['disetujui_pembina', 'disetujui_staf', 'laporan_disubmit', 'laporan_diverifikasi', 'selesai'])->count();
        });

        $totalDitolak = Cache::remember($cacheKeyPrefix . ':ditolak', now()->addMinutes(15), function () use ($user) {
            return Proposal::where('user_id', $user->id)->whereIn('status', ['ditolak_pembina', 'ditolak_staf'])->count();
        });
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