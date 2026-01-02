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

// VIVA TEST ROUTE: Ye route viva ke liye banaya gaya hai.
// Is se hum check karte hain ke Passport sahi kaam kar raha hai ya nahi.
// Ye route automatically pehle user ka Token bana kar return karta hai.
Route::get('/test-passport', function () {
    // 1. Pehla user Database se uthao
    $user = \App\Models\User::first();

    // 2. Agar user nahi mila, to error do
    if (!$user) {
        return response()->json(['error' => 'No users found. Please register a user first.'], 404);
    }

    // 3. User ke liye naya Token generate karo (Passport ka method)
    $token = $user->createToken('VivaTestToken')->accessToken;

    // 4. Token aur message return karo
    return response()->json([
        'message' => 'Passport is working correctly! (Viva Verification)',
        'user' => $user->name,
        'token' => $token
    ]);
});


