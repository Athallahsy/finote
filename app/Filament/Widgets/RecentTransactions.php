<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class RecentTransactions extends Widget
{
    protected static string $view = 'filament.widgets.recent-transactions';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '30s';

    public function getTransactions()
    {
        return Transaction::with('category')
            ->where('user_id', Auth::id())
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->take(5)
            ->get();
    }
}
