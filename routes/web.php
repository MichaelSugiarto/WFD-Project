<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SparepartController;



// user
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/book', [UserController::class, 'book'])->name('book');
    Route::post('/book', [UserController::class, 'storeBooking'])->name('booking.store');
    Route::get('/history', [UserController::class, 'history'])->name('history');
});


//admin (nanti diubah kalau sudah ada login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
    Route::get('/processLogin', [AuthController::class, 'processLogin'])->name('process');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::middleware(RoleMiddleware::class . ':Manager,Supplier')->group(function () {
        Route::get('/sparepart', [SparepartController::class, 'view'])->name('allSparepart');
        Route::post('/store-sparepart', [SparepartController::class, 'storeSparepart'])->name('storeSparepart');
    });

    Route::middleware(RoleMiddleware::class . ':Manager,Technician')->group(function () {
        Route::get('/service-history', [ServiceController::class, 'view'])->name('serviceHistory');
    });
});

Route::fallback(function () {
    return redirect()->route('user.home');
});