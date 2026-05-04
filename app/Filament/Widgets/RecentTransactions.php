<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class RecentTransactions extends Widget
{
<<<<<<< HEAD
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
=======

    protected static string $view = 'filament.widgets.recent-transactions'; // [!] View file nanti kita buat
    protected static ?int $sort = 4; // Biar tampil setelah charts
    protected int | string | array $columnSpan = 'full'; // Lebar penuh
    protected static ?string $pollingInterval = '10s';

    public function getTransactions()
    {

        return Transaction::with('category')
            ->where('user_id', Auth::id())
            ->latest()
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            ->take(5)
            ->get();
    }
}
