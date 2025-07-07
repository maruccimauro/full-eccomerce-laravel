<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;

//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//addresses
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::get('/addresses/{address}', [AddressController::class, 'show']);
    Route::put('/addresses/{address}', [AddressController::class, 'update']);
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);
});


//products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});

//ProductImage
Route::get('/categories', [categoryController::class, 'index']);
Route::get('/categories/{category}', [categoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories', [categoryController::class, 'store']);
    Route::put('/categories/{category}', [categoryController::class, 'update']);
    Route::delete('/categories/{category}', [categoryController::class, 'destroy']);
});



//ProductImage
Route::get('/productImages', [ProductImageController::class, 'index']);
Route::get('/productImages/{productImage}', [ProductImageController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/productImages', [ProductImageController::class, 'store']);
    Route::put('/productImages/{productImage}', [ProductImageController::class, 'update']);
    Route::delete('/productImages/{productImage}', [ProductImageController::class, 'destroy']);
});


//cart
Route::get('/carts', [CartController::class, 'index']);
Route::get('/carts/{cart}', [CartController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/carts', [CartController::class, 'store']);
    Route::put('/carts/{cart}', [CartController::class, 'update']);
    Route::delete('/carts/{cart}', [CartController::class, 'destroy']);
});


//cartItem
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cartitems', [CartitemController::class, 'index']);
    Route::get('/cartitems/{cartitems}', [CartitemController::class, 'show']);
    Route::post('/cartitems', [CartitemController::class, 'store']);
    Route::put('/cartitems/{cartitem}', [CartitemController::class, 'update']);
    Route::delete('/cartitems/{cartitem}', [CartitemController::class, 'destroy']);
});
