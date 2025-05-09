<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CategoryChart;
use App\Filament\Widgets\IncomeOutcomeChart;
use App\Filament\Widgets\SummaryStatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Widgets\RecentTransactions;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{

    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('startDate')
                            ->maxDate(fn ($get) => $get('endDate') ?: now())
                            ->default(now()->startOfMonth()),

                        \Filament\Forms\Components\DatePicker::make('endDate')
                            ->minDate(fn ($get) => $get('startDate') ?: now())
                            ->maxDate(now())
                            ->default(now()),
                    ])
                    ->columns(2),
            ]);
    }

    public function getColumns(): int|array
    {
        return [
            'md' => 2,  // Desktop: 2 kolom
            'default' => 1, // Mobile: 1 kolom
        ];
    }

    public function getWidgets(): array
    {
        return [
            SummaryStatsOverview::class,
            CategoryChart::class,
            IncomeOutcomeChart::class,
        ];

    }


    public function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            FilamentInfoWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            RecentTransactions::class,
        ];
    }


}
