<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class CategoryChart extends ApexChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = '📊 Pengeluaran per Kategori';
    protected static ?string $description = 'Ringkasan pengeluaran berdasarkan kategori.';
    protected int | string | array $columnSpan = 1;
    protected static ?string $pollingInterval = 'null'; // boleh diatur ke null jika ingin fetch manual

    protected function getOptions(): array
    {
        $start = isset($this->filters['startDate'])
    ? Carbon::parse($this->filters['startDate'])->startOfDay()
    : now()->startOfMonth()->startOfDay();

    $end = isset($this->filters['endDate'])
        ? Carbon::parse($this->filters['endDate'])->endOfDay()
        : now()->endOfDay();

    $data = Transaction::where('jenis', 'expanse')
        ->whereBetween('created_at', [$start, $end])
        ->selectRaw('SUM(jumlah) as total, category_id')
        ->groupBy('category_id')
        ->with('category')
        ->get();

    // Handle empty data
    $labels = $data->isEmpty()
        ? ['Tidak ada data']
        : $data->map(fn ($item) => $item->category->nama ?? 'Tidak diketahui')->toArray();

    $totals = $data->isEmpty()
        ? [0]
        : $data->pluck('total')->map(fn ($total) => (float) $total)->toArray();

        return [
            'series' => $totals,
            'chart' => [
                'type' => 'donut',
                'height' => 300,
                'toolbar' => ['show' => false],
                'background' => 'transparent',
            ],
            'labels' => $labels,
            'colors' => ['#E6C200', '#1E2A38', '#50C878', '#D72638', '#E5E5E5'],
            'plotOptions' => [
                'pie' => [
                    'donut' => [
                        'size' => '65%',
                    ]
                ]
            ],
        ];
    }
}
