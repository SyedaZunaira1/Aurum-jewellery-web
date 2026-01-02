<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api'); // PASSPORT: 'auth:api' middleware ensure karta hai ke request valid token ke sath aye.

// Public Product APIs
// These routes return JSON data.
Route::get('/products', [ProductApiController::class, 'index']); // Get all products
Route::get('/products/{id}', [ProductApiController::class, 'show']); // Get single product
Route::post('/products', [ProductApiController::class, 'store']); // Create product
Route::put('/products/{id}', [ProductApiController::class, 'update']); // Update product
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']); // Delete product


