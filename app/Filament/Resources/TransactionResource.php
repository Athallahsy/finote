<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('judul')->required()->label('Judul Transaksi'),
        TextInput::make('jumlah')
            ->numeric()
            ->required()
            ->prefix('Rp')
            ->label('Jumlah'),
        DatePicker::make('tanggal')->required()->label('Tanggal'),
        Select::make('jenis')
            ->options([
                'income' => 'Pemasukan',
                'expanse' => 'Pengeluaran',
            ])
            ->required()
            ->label('Jenis'),
        Select::make('category_id')
            ->relationship('category', 'nama')
            ->searchable()
            ->required()
            ->label('Kategori'),
        Textarea::make('keterangan')->label('Keterangan')->rows(3),
            ]);

}


public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('judul')->label('Judul')->searchable(),
            TextColumn::make('jumlah')->label('Harga')->money('IDR'),
            TextColumn::make('tanggal')->label('Tanggal')->date(),
            TextColumn::make('jenis')
                ->badge()
                ->icon(fn (string $state): string => match ($state) {
                    'income' => 'heroicon-o-arrow-trending-up',
                    'expanse' => 'heroicon-o-arrow-trending-down',
                })
                ->color(fn (string $state): string => match ($state) {
                    'income' => 'success',
                    'expanse' => 'danger',
                }),
            TextColumn::make('category.nama')->label('Kategori'),
            TextColumn::make('keterangan')->label('Keterangan'),
        ])
        ->filters([
            SelectFilter::make('jenis')
                ->options([
                    'income' => 'Pemasukan',
                    'expanse' => 'Pengeluaran',
                ])
                ->label('Jenis Transaksi'),

                Filter::make('tanggal')
                ->form([
                    DatePicker::make('from')->label('Dari'),
                    DatePicker::make('until')->label('Sampai'),
                ])
                ->query(function ($query, array $data) {
                    return $query
                        ->when($data['from'], fn ($q) => $q->whereDate('tanggal', '>=', $data['from']))
                        ->when($data['until'], fn ($q) => $q->whereDate('tanggal', '<=', $data['until']));
                }),

            SelectFilter::make('category_id')
                ->relationship('category', 'nama')
                ->searchable()
                ->label('Kategori'),
        ])

        ->headerActions([
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Konfirmasi Ekspor')
                ->modalSubheading('Apakah Anda yakin ingin mengekspor data yang difilter ke PDF?')
                ->modalButton('Ya, Ekspor')
                ->action(function ($livewire) {
                    try {
                        $records = $livewire->getFilteredSortedTableQuery()->get();

                        // Validasi data kosong
                        if ($records->isEmpty()) {
                            throw new \Exception('Tidak ada data transaksi berdasarkan filter yang dipilih');
                        }

                        // Konversi data ke UTF-8
                        $cleanData = $records->map(function ($item) {
                            return [
                                'judul' => mb_convert_encoding($item->judul, 'UTF-8', 'UTF-8'),
                                'created_at' => $item->created_at->format('d F Y'),
                                'jumlah' => 'Rp' . number_format($item->jumlah, 0, ',', '.'),
                                'jenis' => $item->jenis === 'income' ? 'Pemasukan' : 'Pengeluaran',
                                'kategori' => mb_convert_encoding(optional($item->category)->nama ?? '-', 'UTF-8', 'UTF-8'),
                                'keterangan' => mb_convert_encoding($item->keterangan ?? '', 'UTF-8', 'UTF-8')
                            ];
                        });

                        $pdf = Pdf::loadView('pdf.transactions', ['records' => $cleanData])
                            ->setPaper('a4', 'landscape')
                            ->setOption('defaultFont', 'DejaVu Sans')
                            ->setOption('isHtml5ParserEnabled', true)
                            ->setOption('isRemoteEnabled', true)
                            ->setOption('charset', 'UTF-8');

                        $filename = 'laporan-transaksi-' . now()->format('Y-m-d') . '.pdf';

                        Notification::make()
                            ->title('Export Berhasil')
                            ->body('File PDF sudah siap diunduh')
                            ->success()
                            ->send();

                        return response()->streamDownload(
                            fn () => print($pdf->stream()),
                            $filename,
                            [
                                'Content-Type' => 'application/pdf',
                                'Content-Disposition' => 'attachment'
                            ]
                        );

                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Export Gagal')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();

                        throw $e;
                    }
                })
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);

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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),

        ];
    }
}
