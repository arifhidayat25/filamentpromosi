<?php

namespace App\Filament\Widgets;

use App\Models\Proposal;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProposalChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'proposalTrendChart'; // PERBAIKAN: Menambahkan ?

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Tren Pengajuan Proposal per Bulan';
    
    protected static ?int $sort = 2;

    /**
     * Chart options
     */
    protected function getOptions(): array
    {
        $data = Proposal::select(
                DB::raw('COUNT(id) as count'), 
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->map(fn($item) => Carbon::createFromFormat('Y-m', $item->month)->format('F'));
        $values = $data->pluck('count');

        return [
            'chart' => [
                'type' => 'area',
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
            'colors' => ['#3b82f6'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}