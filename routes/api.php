<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\MetadataController;
use App\Http\Controllers\Api\SubMetadataController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\HistoryDiscountUsageController;

// Users
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/profile', [UserController::class, 'profile']);
Route::get('users/{user}', [UserController::class, 'show']);

// Discount routes
Route::get('discounts', [DiscountController::class, 'index']);
Route::post('discounts', [DiscountController::class, 'store']);
Route::post('discounts/apply', [DiscountController::class, 'apply']);
Route::get('discounts/{discount}', [DiscountController::class, 'show']);
Route::put('discounts/{discount}', [DiscountController::class, 'update']);
Route::delete('discounts/{discount}', [DiscountController::class, 'destroy']);

// History Discount Usage
Route::get('history-discount-usages', [HistoryDiscountUsageController::class, 'index']);
Route::get('history-discount-usages/{historyDiscountUsage}', [HistoryDiscountUsageController::class, 'show']);

// Wallet routes
Route::get('wallets', [WalletController::class, 'index']);
Route::put('wallets/{wallet}', [WalletController::class, 'update']);
Route::get('wallets/{wallet}', [WalletController::class, 'show']);

// Metadata routes
Route::get('metadatas', [MetadataController::class, 'index']);
Route::post('metadatas', [MetadataController::class, 'store']);
Route::get('metadatas/{metadata}', [MetadataController::class, 'show']);
Route::put('metadatas/{metadata}', [MetadataController::class, 'update']);

// SubMetadata routes
Route::get('sub-metadatas', [SubMetadataController::class, 'index']);
Route::post('sub-metadatas', [SubMetadataController::class, 'store']);
Route::get('sub-metadatas/{subMetadata}', [SubMetadataController::class, 'show']);
Route::put('sub-metadatas/{subMetadata}', [SubMetadataController::class, 'update']);
