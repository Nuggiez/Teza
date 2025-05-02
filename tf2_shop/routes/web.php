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

Route::prefix('admin')->group(function(){
    Route::get('category',[App\Http\Controllers\Admin\CategoryController::class,'index']);
    Route::get('category/create',[App\Http\Controllers\Admin\CategoryController::class,'create']);
    Route::post('category',[App\Http\Controllers\Admin\CategoryController::class,'store']);

});
require __DIR__.'/auth.php';