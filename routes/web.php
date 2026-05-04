<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionPdfController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);


// PDF export route — must be authenticated. Filtering by user_id is also
// enforced in the controller as defense-in-depth.
Route::middleware(['auth'])->group(function () {
    Route::get('admin/transactions/pdf', [TransactionPdfController::class, 'export'])
        ->name('transactions.pdf');
});
