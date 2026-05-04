<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class IncomeOutcomeChart extends ApexChartWidget
{
    protected static ?string $heading = '⚖️ Income vs Expense';
    protected static bool $hasContainer = true;
    protected static ?string $pollingInterval = '30s';

    protected function getOptions(): array
    {
        $months = 6;
        $dates = [];
        $incomeData = [];
        $expenseData = [];

        for ($i = $months; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $dates[] = $date->format('M Y');

            $incomeData[] = (float) Transaction::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->where('jenis', 'income')
                ->where('user_id', Auth::id())
                ->sum('jumlah');

            $expenseData[] = (float) Transaction::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->where('jenis', 'expense')
                ->where('user_id', Auth::id())
                ->sum('jumlah');
        }

        return [
            'chart' => [
                'type'    => 'area',
                'height'  => 290,
                'toolbar' => ['show' => false],
                'zoom'    => ['enabled' => false],
                'animations' => [
                    'enabled' => true,
                    'easing'  => 'easeinout',
                    'speed'   => 800,
                ],
            ],
            'series' => [
                ['name' => 'Income',  'data' => $incomeData],
                ['name' => 'Expense', 'data' => $expenseData],
            ],
            'xaxis' => [
                'categories' => $dates,
                'labels' => [
                    'style' => [
                        'colors'   => '#94a3b8',
                        'fontSize' => '12px',
                    ],
                ],
                'axisBorder' => ['show' => false],
                'axisTicks'  => ['show' => false],
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 3,
            ],
            'colors'  => ['#4CAF50', '#F44336'],
            'markers' => [
                'size'         => 5,
                'colors'       => ['#3D9970', '#FF6B6B'],
                'strokeWidth'  => 3,
                'strokeColors' => '#fff',
                'hover'        => ['size' => 7],
            ],
            'tooltip' => [
                'theme' => 'dark',
                'x'     => ['format' => 'MMM yyyy'],
            ],
            'grid' => [
                'borderColor'      => '#e0e0e0',
                'strokeDashArray'  => 4,
            ],
        ];
    }
}
