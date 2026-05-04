<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryChart extends ApexChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = '📊 Pengeluaran per Kategori';
    protected static ?string $description = 'Ringkasan pengeluaran berdasarkan kategori.';
    protected int | string | array $columnSpan = 1;
<<<<<<< HEAD
    protected static ?string $pollingInterval = null;
=======
    protected static ?string $pollingInterval = 'null'; // boleh diatur ke null jika ingin fetch manual
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536

    protected function getOptions(): array
    {
        $start = isset($this->filters['startDate'])
            ? Carbon::parse($this->filters['startDate'])->startOfDay()
            : now()->startOfMonth()->startOfDay();

        $end = isset($this->filters['endDate'])
            ? Carbon::parse($this->filters['endDate'])->endOfDay()
            : now()->endOfDay();

<<<<<<< HEAD
        $data = Transaction::where('jenis', 'expense')
            ->where('user_id', Auth::id())
            ->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])
=======
        $data = Transaction::where('jenis', 'expanse')
            ->where('user_id', Auth::id())
            ->whereBetween('created_at', [$start, $end])
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            ->selectRaw('SUM(jumlah) as total, category_id')
            ->groupBy('category_id')
            ->with('category')
            ->get();

<<<<<<< HEAD
        $labels = $data->isEmpty()
            ? ['Tidak ada data']
            : $data->map(fn ($item) => $item->category->nama ?? 'Tidak diketahui')->toArray();

        $totals = $data->isEmpty()
            ? [0]
            : $data->pluck('total')->map(fn ($total) => (float) $total)->toArray();
=======
        // Handle empty data
        $labels = $data->isEmpty()
            ? ['Tidak ada data']
            : $data->map(fn($item) => $item->category->nama ?? 'Tidak diketahui')->toArray();

        $totals = $data->isEmpty()
            ? [0]
            : $data->pluck('total')->map(fn($total) => (float) $total)->toArray();
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536

        return [
            'series' => $totals,
            'chart' => [
<<<<<<< HEAD
                'type'       => 'donut',
                'height'     => 300,
                'toolbar'    => ['show' => false],
=======
                'type' => 'donut',
                'height' => 300,
                'toolbar' => ['show' => false],
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
                'background' => 'transparent',
            ],
            'labels' => $labels,
            'colors' => ['#E6C200', '#1E2A38', '#50C878', '#D72638', '#E5E5E5'],
            'plotOptions' => [
                'pie' => [
<<<<<<< HEAD
                    'donut' => ['size' => '65%'],
                ],
=======
                    'donut' => [
                        'size' => '65%',
                    ]
                ]
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            ],
        ];
    }
}
