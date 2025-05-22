<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('nama')->required()->label('Nama Kategori'),

        Select::make('jenis')
            ->options([
                'income' => 'Pemasukan',
                'expanse' => 'Pengeluaran',
            ])
            ->required()
            ->label('Jenis'),
    ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nama')->label('Nama'),
            TextColumn::make('jenis')
    ->label('Jenis')
    ->badge()
    ->icon(fn (string $state): string => match ($state) {
        'income' => 'heroicon-o-arrow-trending-up',
        'expanse' => 'heroicon-o-arrow-trending-down',
        default => 'heroicon-o-question-mark-circle',
    })
    ->color(fn (string $state): string => match ($state) {
        'income' => 'success',
        'expanse' => 'danger',
        default => 'gray',
    }),


            TextColumn::make('created_at')->label('Dibuat')->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
}

    public static function canCreate(): bool
    {
        return false; // nonaktifkan tombol
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
