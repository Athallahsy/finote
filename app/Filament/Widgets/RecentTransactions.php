<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class RecentTransactions extends Widget
{

    protected static string $view = 'filament.widgets.recent-transactions'; // [!] View file nanti kita buat
    protected static ?int $sort = 4; // Biar tampil setelah charts
    protected int | string | array $columnSpan = 'full'; // Lebar penuh
    protected static ?string $pollingInterval = '10s';

    public function getTransactions()
    {

        return Transaction::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();
    }
}
