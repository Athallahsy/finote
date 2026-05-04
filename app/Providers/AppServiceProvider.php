<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filament\Widgets\SummaryStatsOverview;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('summary-stats-overview', SummaryStatsOverview::class);
    }
}
