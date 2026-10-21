<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/products', [ProductController::class, 'index'])->name('product'); 

// Route::post('/products', [ProductController::class, 'store'])->name('product.store'); 
// Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update'); 
// Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
// Route::apiResource('products', ProductController::class);

// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori'); 
// Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store'); 
// Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update'); 
// Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
// Route::apiResource('kategori', KategoriController::class);

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('jwt')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('profile', [AuthController::class, 'profile'])->name('profile');
        Route::apiResource('products', ProductController::class);
        Route::apiResource('kategori', KategoriController::class);
    });
});

Route::middleware('jwt')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('kategori', KategoriController::class);
});