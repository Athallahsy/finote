<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;

// Public (tanpa auth)
Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);

// Protected (dengan auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users',    [AuthController::class, 'user'])->middleware('admin');

    Route::get('user', [UserController::class, 'index']);
    Route::put('user', [UserController::class, 'update']);
    Route::delete('user', [UserController::class, 'destroy']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('transactions', TransactionController::class);
});
