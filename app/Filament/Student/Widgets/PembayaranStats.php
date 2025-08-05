<?php

namespace App\Filament\Student\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PembayaranStats extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();

        $totalDibayar = Payment::whereHas('proposal', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'dibayar')->sum('amount');

        $menungguPembayaran = Payment::whereHas('proposal', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'menunggu_pembayaran')->sum('amount');

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