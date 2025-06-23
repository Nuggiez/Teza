<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FundRequestController as AdminFundRequestController;
use App\Http\Controllers\Admin\ClaimRequestController as AdminClaimRequestController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FundRequestController;
use App\Http\Controllers\Frontend\ClaimRequestController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profile
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

// Admin
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    // Categories
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('orders/{order}/complete', [AdminOrderController::class, 'complete'])->name('orders.complete');
    // Fund Requests
    Route::get('fund-requests', [AdminFundRequestController::class, 'index'])->name('fund_requests.index');
    Route::post('fund-requests/{fund_request}/complete', [AdminFundRequestController::class, 'complete'])->name('fund_requests.complete');
    Route::post('fund-requests/{fund_request}/reject', [AdminFundRequestController::class, 'reject'])->name('fund_requests.reject');
    // Claim Requests
    Route::get('claim-requests', [AdminClaimRequestController::class, 'index'])->name('claim_requests.index');
    Route::post('claim-requests/{claim_request}/complete', [AdminClaimRequestController::class, 'complete'])->name('claim_requests.complete');
    Route::post('claim-requests/{claim_request}/reject', [AdminClaimRequestController::class, 'reject'])->name('claim_requests.reject');
});

// Public (user-facing) routes
// Products
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('products/single', [ProductController::class, 'index2'])->name('products.single.index');
Route::get('products/single/{id}', [ProductController::class, 'showSingle'])->name('products.single.show');
Route::get('products/search', [ProductController::class, 'search'])->name('products.search');

// Categories
Route::get('categories/{category}', [CategoryController::class, 'index'])->name('categories.show');

// Cart
Route::get('cart', [CartController::class, 'index'])->name('cart.index'); // Add if you have a cart page
Route::post('cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('checkout', [CheckoutController::class, 'cart'])->name('checkout.cart');
Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout.process');

// Contact
Route::get('contact', [ContactUsController::class, 'index'])->name('contact');

// Fund and Claim Requests
Route::post('fund-request', [FundRequestController::class, 'store'])->name('fund_request.store');
Route::post('claim-request', [ClaimRequestController::class, 'store'])->name('claim_request.store');

require __DIR__ . '/auth.php';
