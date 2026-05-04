<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Transaction;
use Filament\Pages\Dashboard\Concerns\HasFilters;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SummaryStatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    use HasFilters;

    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $start = $this->filters['startDate'] ?? now()->startOfMonth();
        $end   = $this->filters['endDate']   ?? now()->endOfMonth();

        $startDate = Carbon::parse($start)->startOfDay();
        $endDate   = Carbon::parse($end)->endOfDay();

        // Use semantic 'tanggal' column for accurate monthly reporting
        $currentIncome = Transaction::where('jenis', 'income')
            ->where('user_id', Auth::id())
            ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->sum('jumlah');

        $currentExpense = Transaction::where('jenis', 'expense')
            ->where('user_id', Auth::id())
            ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->sum('jumlah');

        // Previous period (same length, immediately before current range)
        $diffDays = $startDate->diffInDays($endDate) + 1;
        $prevEnd   = $startDate->copy()->subDay()->endOfDay();
        $prevStart = $prevEnd->copy()->subDays($diffDays - 1)->startOfDay();

        $previousIncome = Transaction::where('jenis', 'income')
            ->where('user_id', Auth::id())
            ->whereBetween('tanggal', [$prevStart->toDateString(), $prevEnd->toDateString()])
            ->sum('jumlah');

        $previousExpense = Transaction::where('jenis', 'expense')
            ->where('user_id', Auth::id())
            ->whereBetween('tanggal', [$prevStart->toDateString(), $prevEnd->toDateString()])
            ->sum('jumlah');

        $monthlyBalance = $currentIncome - $currentExpense;

        $formatCurrency = fn ($v) => 'Rp ' . number_format($v, 0, ',', '.');

        return [
            Card::make('Income', $formatCurrency($currentIncome))
                ->description($this->getChangeDescription($currentIncome, $previousIncome))
                ->descriptionIcon($this->getTrendIcon($currentIncome, $previousIncome))
                ->color('success')
                ->icon('heroicon-s-arrow-trending-up')
                ->chart($this->getMonthlyTrend('income', $startDate, $endDate)),

            Card::make('Expense', $formatCurrency($currentExpense))
                ->description($this->getChangeDescription($currentExpense, $previousExpense))
                ->descriptionIcon($this->getTrendIcon($currentExpense, $previousExpense))
                ->color('danger')
                ->icon('heroicon-s-arrow-trending-down')
                ->chart($this->getMonthlyTrend('expense', $startDate, $endDate)),

            Card::make('Balance', $formatCurrency($monthlyBalance))
                ->description($this->getBalanceDescription($monthlyBalance, ($currentIncome + $currentExpense)))
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

        return sprintf(
            '%s%.2f%% from previous period',
            $change >= 0 ? '+' : '-',
            $absChange
        );
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
                ->where('user_id', Auth::id())
                ->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
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
                ->where('user_id', Auth::id())
                ->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('jumlah');

            $expense = Transaction::where('jenis', 'expense')
                ->where('user_id', Auth::id())
                ->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('jumlah');

            $trend[] = $income - $expense;
            $date->addMonth();
        }

        return $trend;
    }
}
