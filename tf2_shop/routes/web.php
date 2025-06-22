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
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('admin.orders.index');
        Route::post('/orders/{order}/complete', 'complete')->name('admin.orders.complete');
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
        Route::get('/product/single/{id}', 'showSingle')->name('product.single');
    });

    Route::get('/search', [App\Http\Controllers\Frontend\ProductController::class, 'search']);

    Route::controller(App\Http\Controllers\Frontend\CategoryController::class)->group(function () {
        Route::get('/category/{category}', 'index');
    });

    Route::controller(App\Http\Controllers\Frontend\CheckoutController::class)->group(function () {
        Route::get('/checkout/cart', 'cart')->name('cart');
        Route::post('/checkout/checkout', 'checkout')->name('checkout.process');
    });

    Route::controller(App\Http\Controllers\Frontend\ContactUsController::class)->group(function () {
        Route::get('/contact_us', 'index')->name('contact');
    });

    Route::controller(App\Http\Controllers\Frontend\CartController::class)->group(function () {
        Route::post('/cart/add/{product}', 'add')->name('cart.add');
        Route::delete('/cart/remove/{cart}', 'remove')->name('cart.remove');
    });
});

require __DIR__ . '/auth.php';
