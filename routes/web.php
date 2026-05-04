<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionPdfController;
<<<<<<< HEAD
use App\Http\Controllers\Auth\RegisterController;
=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);


// PDF export route — must be authenticated. Filtering by user_id is also
// enforced in the controller as defense-in-depth.
Route::middleware(['auth'])->group(function () {
    Route::get('admin/transactions/pdf', [TransactionPdfController::class, 'export'])
        ->name('transactions.pdf');
});
=======

// Route untuk download PDF (bisa tetap di web.php)
Route::get('admin/transactions/pdf', [TransactionPdfController::class, 'export'])
     ->name('transactions.pdf');
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
