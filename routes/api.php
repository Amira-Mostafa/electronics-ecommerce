<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('products', ProductController::class);
Route::post('/checkout', [UserController::class, 'checkout']);
Route::get('/products', [ProductController::class, 'index']);
// Route::post('/purchase' , [UsersController::class , 'purchase']);