<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//Category

Route::prefix('admin')->group(function () {
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');

        Route::get('/category/create', 'create');
        Route::post('/category', 'store');

        Route::get('category/edit/{category}', 'edit');
        Route::put('category/{category}', 'update');
    });
});

Route::prefix('frontend')->group(function () {
    Route::controller(App\Http\Controllers\Frontend\ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('sell');

        Route::get('/product/create', 'create');
        Route::post('/product', 'store');

        Route::get('product/edit/{product}', 'edit');
        Route::put('product/{product}', 'update');

        Route::get('/category', 'index');

        Route::get('/product/single', 'index2');
    });

    Route::controller(App\Http\Controllers\Frontend\CategoryController::class)->group(function () {
        Route::get('/category/{category}', 'index');
    });

    Route::controller(App\Http\Controllers\Frontend\CheckoutController::class)->group(function () {
        Route::get('/checkout/cart', 'cart')->name('cart');
    });

    Route::controller(App\Http\Controllers\Frontend\ContactUsController::class)->group(function () {
        Route::get('/contact_us', 'index')->name('contact');
    });
});

require __DIR__ . '/auth.php';
