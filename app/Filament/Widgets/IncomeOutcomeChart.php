<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class IncomeOutcomeChart extends ApexChartWidget
{
<<<<<<< HEAD
    protected static ?string $heading = '⚖️ Income vs Expense';
    protected static bool $hasContainer = true;
    protected static ?string $pollingInterval = '30s';
=======
    protected static ?string $heading = '⚖️ Income vs Expanse';
    protected static bool $hasContainer = true;
    protected static ?string $pollingInterval = '10s';
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536

    protected function getOptions(): array
    {
        $months = 6;
        $dates = [];
        $incomeData = [];
<<<<<<< HEAD
        $expenseData = [];
=======
        $expanseData = [];
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536

        for ($i = $months; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $dates[] = $date->format('M Y');

<<<<<<< HEAD
            $incomeData[] = (float) Transaction::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
=======
            $incomeData[] = (float) Transaction::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
                ->where('jenis', 'income')
                ->where('user_id', Auth::id())
                ->sum('jumlah');

<<<<<<< HEAD
            $expenseData[] = (float) Transaction::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->where('jenis', 'expense')
=======
            $expanseData[] = (float) Transaction::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('jenis', 'expanse')
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
                ->where('user_id', Auth::id())
                ->sum('jumlah');
        }

        return [
            'chart' => [
<<<<<<< HEAD
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
=======
                'type' => 'area',
                'height' => 290,
                'toolbar' => ['show' => false],
                'zoom' => ['enabled' => false],
                'animations' => [
                    'enabled' => true,
                    'easing' => 'easeinout',
                    'speed' => 800,
                ],
            ],
            'series' => [
                ['name' => 'Income', 'data' => $incomeData],
                ['name' => 'Expanse', 'data' => $expanseData],
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            ],
            'xaxis' => [
                'categories' => $dates,
                'labels' => [
                    'style' => [
<<<<<<< HEAD
                        'colors'   => '#94a3b8',
=======
                        'colors' => '#94a3b8', // abu muda
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
                        'fontSize' => '12px',
                    ],
                ],
                'axisBorder' => ['show' => false],
<<<<<<< HEAD
                'axisTicks'  => ['show' => false],
=======
                'axisTicks' => ['show' => false],
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 3,
            ],
<<<<<<< HEAD
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
=======
            'colors' => ['#4CAF50', '#F44336'], // hijau mewah dan merah elegan
            'markers' => [
                'size' => 5,
                'colors' => ['#3D9970', '#FF6B6B'],
                'strokeWidth' => 3,
                'strokeColors' => '#fff',
                'hover' => ['size' => 7],
            ],
            'tooltip' => [
                'theme' => 'dark',
                'x' => [
                    'format' => 'MMM yyyy',
                ],
            ],
            'grid' => [
                'borderColor' => '#e0e0e0',
                'strokeDashArray' => 4,
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            ],
        ];
    }
}
