<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Transaction;
use Filament\Pages\Dashboard\Concerns\HasFilters;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class SummaryStatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    use HasFilters;
    protected static ?string $pollingInterval = '10s'; // Auto-refresh every 10 seconds
    protected static ?int $sort = 1; // Widget display order

    protected function getCards(): array
{

    $start = $this->filters['startDate'] ?? now()->startOfMonth();
    $end = $this->filters['endDate'] ?? now()->endOfMonth();

    $startDate = Carbon::parse($start)->startOfDay();
    $endDate = Carbon::parse($end)->endOfDay();

    $currentIncome = Transaction::where('jenis', 'income')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->sum('jumlah');

    $currentExpanse = Transaction::where('jenis', 'expanse')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->sum('jumlah');

    $monthlyBalance = $currentIncome - $currentExpanse;

    // Hitung rentang waktu sebelumnya untuk perbandingan
    $previousStart = $startDate->copy()->subDays($endDate->diffInDays($startDate) + 1);
    $previousEnd = $startDate->copy()->subDay();

    $previousIncome = Transaction::where('jenis', 'income')
        ->whereBetween('created_at', [$previousStart, $previousEnd])
        ->sum('jumlah');

    $previousExpanse = Transaction::where('jenis', 'expanse')
        ->whereBetween('created_at', [$previousStart, $previousEnd])
        ->sum('jumlah');

    $formatCurrency = fn ($amount) => 'Rp ' . number_format($amount, 0, ',', '.');

    return [
        Card::make('Total Income', $formatCurrency($currentIncome))
            ->description($this->getChangeDescription($currentIncome, $previousIncome))
            ->descriptionIcon($this->getTrendIcon($currentIncome, $previousIncome))
            ->color('success')
            ->icon('heroicon-s-arrow-trending-up')
            ->chart($this->getMonthlyTrend('income', $startDate, $endDate)),

        Card::make('Total Expanse', $formatCurrency($currentExpanse))
            ->description($this->getChangeDescription($currentExpanse, $previousExpanse))
            ->descriptionIcon($this->getTrendIcon($currentExpanse, $previousExpanse))
            ->color('danger')
            ->icon('heroicon-s-arrow-trending-down')
            ->chart($this->getMonthlyTrend('expanse', $startDate, $endDate)),

        Card::make('Balance', $formatCurrency($monthlyBalance))
            ->description($this->getBalanceDescription($monthlyBalance, ($currentIncome + $currentExpanse)))
            ->descriptionIcon($monthlyBalance >= 0 ? 'heroicon-s-arrow-up' : 'heroicon-s-arrow-down')
            ->color($monthlyBalance >= 0 ? 'success' : 'danger')
            ->icon($monthlyBalance >= 0 ? 'heroicon-s-banknotes' : 'heroicon-s-exclamation-circle')
            ->chart($this->getBalanceTrend($startDate, $endDate)),
    ];
}


    protected function getChangeDescription(float $current, float $previous): string
    {
        if ($previous == 0) return 'No previous data';

        $change = (($current - $previous) / $previous) * 100;
        $absChange = abs($change);

        return sprintf('%s%.2f%% from last month',
            $change >= 0 ? '+' : '-',
            $absChange);
    }

    protected function getTrendIcon(float $current, float $previous): string
    {
        if ($previous == 0) return 'heroicon-s-minus';
        return $current >= $previous ? 'heroicon-s-arrow-up' : 'heroicon-s-arrow-down';
    }

    protected function getBalanceDescription(float $balance, float $total): string
    {
        if ($total == 0) return 'No transactions';

        $percentage = abs($balance / $total * 100);
        return $balance >= 0
            ? sprintf('Surplus %.2f%% of total', $percentage)
            : sprintf('Deficit %.2f%% of total', $percentage);
    }

    protected function getMonthlyTrend(string $type, Carbon $startDate, Carbon $endDate): array
    {
        $data = [];
        $date = $startDate->copy()->startOfMonth();

        while ($date <= $endDate) {
            $amount = Transaction::where('jenis', $type)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('jumlah');

            $data[] = $amount;
            $date->addMonth();
        }

        return $data;
    }

    protected function getBalanceTrend(Carbon $startDate, Carbon $endDate): array
    {
        $trend = [];
        $date = $startDate->copy()->startOfMonth();

        while ($date <= $endDate) {
            $income = Transaction::where('jenis', 'income')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('jumlah');

            $expanse = Transaction::where('jenis', 'expanse')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('jumlah');

            $trend[] = $income - $expanse;
            $date->addMonth();
        }

        return $trend;
    }

}
