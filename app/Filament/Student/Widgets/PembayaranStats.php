<?php

namespace App\Filament\Student\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;   // <-- Tambahkan ini untuk caching

class PembayaranStats extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();

         $cacheKeyPrefix = 'stats:pembayaran:' . $userId; // <-- 2. Buat kunci cache yang unik per user

        // Cache data selama 15 menit
        $totalDibayar = Cache::remember($cacheKeyPrefix . ':dibayar', now()->addMinutes(15), function () use ($userId) {
            return Payment::whereHas('proposal', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('status', 'dibayar')->sum('amount');
        });

        $menungguPembayaran = Cache::remember($cacheKeyPrefix . ':menunggu', now()->addMinutes(15), function () use ($userId) {
            return Payment::whereHas('proposal', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('status', 'menunggu_pembayaran')->sum('amount');
        });

        return [
            Stat::make('Total Fee Diterima', 'Rp ' . number_format($totalDibayar, 0, ',', '.'))
                ->description('Akumulasi fee yang sudah dibayarkan')
                ->color('success'),
            Stat::make('Menunggu Pembayaran', 'Rp ' . number_format($menungguPembayaran, 0, ',', '.'))
                ->description('Fee yang akan segera ditransfer')
                ->color('warning'),
        ];
    }
}