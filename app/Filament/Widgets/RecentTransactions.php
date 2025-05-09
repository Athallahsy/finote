<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\Widget;

class RecentTransactions extends Widget
{

    protected static string $view = 'filament.widgets.recent-transactions'; // [!] View file nanti kita buat
    protected static ?int $sort = 4; // Biar tampil setelah charts
    protected int | string | array $columnSpan = 'full' ; // Lebar penuh
    protected static ?string $pollingInterval = '10s';

    public function getTransactions()
    {

        return Transaction::with('category')
            ->latest()
            ->take(5)
            ->get();
    }


}
