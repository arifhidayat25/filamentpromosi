<?php

namespace App\Filament\Widgets;

use App\Models\Proposal;
use App\Models\ProgramStudi;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ProposalsByProdiChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'proposalsByProdiChart'; // PERBAIKAN: Menambahkan ?

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Jumlah Pengajuan per Program Studi';
    
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';

    /**
     * Chart options
     */
    protected function getOptions(): array
    {
        // Logika untuk mengambil data (pastikan relasi 'users.proposals' ada di model ProgramStudi)
        $prodis = ProgramStudi::withCount(['users' => function ($query) {
            $query->whereHas('proposals');
        }])->get();

        // Jika Anda belum punya relasi 'proposals' di model User, tambahkan ini:
        // public function proposals(): HasMany { return $this->hasMany(Proposal::class); }

        $labels = $prodis->pluck('name');
        $values = $prodis->pluck('users_count'); // Menggunakan users_count karena withCount menghitung users

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Jumlah Pengajuan',
                    'data' => $values,
                ],
            ],
            'xaxis' => [
                'categories' => $labels,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
        ];
    }
}