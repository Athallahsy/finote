<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionPdfController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk download PDF (bisa tetap di web.php)
Route::get('admin/transactions/pdf', [TransactionPdfController::class, 'export'])
     ->name('transactions.pdf');
