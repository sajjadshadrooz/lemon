<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;

// Users routes
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{user}', [UserController::class, 'show']);

// Wallet Controller
Route::get('wallets', [WalletController::class, 'index']);
Route::put('wallets/{wallet}', [WalletController::class, 'update']);
Route::get('wallets/{wallet}', [WalletController::class, 'show']);
