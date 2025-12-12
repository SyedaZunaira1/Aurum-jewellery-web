<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductAdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])->name('home'); // homepage
Route::get('/shop', [ProductController::class, 'shop'])->name('shop'); // all products
Route::get('/products/search', [ProductController::class, 'ajaxSearch'])->name('products.search');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\CustomerAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [App\Http\Controllers\CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [App\Http\Controllers\CustomerAuthController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\CustomerAuthController::class, 'logout'])->name('logout');

    // Protected Checkout Routes
    // "auth" middleware ensures ONLY logged-in users can access these pages.
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/thankyou', [CartController::class, 'thankyou'])->name('thankyou');

    // My Orders (READ Operation for Users)
    Route::get('/my-orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
});

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');



/*
/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
| These routes handle the authentication process specifically for Administrators.
| We use a custom 'admin' guard to separate admin login sessions from normal users.
| This separation ensures that an admin login doesn't interfere with a customer login on the same browser.
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (login & register)
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('login.submit');

    // Password Reset Routes
    Route::get('/password/reset', [App\Http\Controllers\Admin\AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Admin\AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\AdminForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Admin\AdminForgotPasswordController::class, 'reset'])->name('password.update');

    // Protected routes (require authentication)
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');

        // Admin Profile Management
        Route::get('/profile', [App\Http\Controllers\Admin\AdminAuthController::class, 'showProfile'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\Admin\AdminAuthController::class, 'updateProfile'])->name('profile.update');

        // Admin Management
        Route::get('/register', [App\Http\Controllers\Admin\AdminAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [App\Http\Controllers\Admin\AdminAuthController::class, 'register'])->name('register.submit');

        // Product management
        Route::get('/products', [ProductAdminController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductAdminController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductAdminController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductAdminController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductAdminController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductAdminController::class, 'destroy'])->name('products.destroy');
        // Category Deletion Route (Handle mass update/delete of products in a category)
        Route::delete('/products/category/delete', [ProductAdminController::class, 'deleteCategory'])->name('products.deleteCategory');
    });
});

