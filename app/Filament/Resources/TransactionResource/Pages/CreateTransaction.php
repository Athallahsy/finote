<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
<<<<<<< HEAD
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
=======
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
<<<<<<< HEAD

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
}
