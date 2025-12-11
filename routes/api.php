<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Product APIs
// These routes return JSON data.
Route::get('/products', [ProductApiController::class, 'index']); // Get all products
Route::get('/products/{id}', [ProductApiController::class, 'show']); // Get single product
