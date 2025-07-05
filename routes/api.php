<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/addresses', [AddressController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/addresses', [AddressController::class, 'store']);
    Route::get('/addresses/{address}', [AddressController::class, 'show']);
    Route::put('/addresses/{address}', [AddressController::class, 'update']);
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});


//ProductImage
Route::get('/productImages', [ProductImageController::class, 'index']);
Route::get('/productImages/{productImage}', [ProductImageController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/productImages', [ProductImageController::class, 'store']);
    Route::put('/productImages/{productImage}', [ProductImageController::class, 'update']);
    Route::delete('/productImages/{productImage}', [ProductImageController::class, 'destroy']);
});
