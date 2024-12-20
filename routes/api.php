<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WalletController;

use App\Http\Controllers\UserController;




    Route::get('/wallets', [WalletController::class, 'index']); // List all wallets
    Route::get('/wallets/{wallet}', [WalletController::class, 'show']); // Show wallet details
    Route::get('/transfer-options', [WalletController::class, 'showTransferOptions']); // Show wallets for transfer
    Route::post('/transfer', [WalletController::class, 'transfer']); // Perform a wallet transfer

Route::get('/users', [UserController::class, 'index']);

