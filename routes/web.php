<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SparepartController;
use App\Http\Middleware\AdminLoginMiddleware;
use App\Http\Controllers\BookingController;

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/book', [UserController::class, 'book'])->name('book');
    Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/history', [UserController::class, 'history'])->name('history');
    Route::get('/history/search', [UserController::class, 'historySearch'])->name('history.search');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication Routes
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
    Route::get('/processLogin', [AuthController::class, 'processLogin'])->name('process');

    // Authenticated Admin Routes
    Route::middleware(AdminLoginMiddleware::class)->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Manager & Supplier Routes
        Route::middleware(RoleMiddleware::class . ':Manager,Supplier')->group(function () {
            Route::get('/sparepart', [SparepartController::class, 'view'])->name('allSparepart');
            Route::post('/store-sparepart', [SparepartController::class, 'storeSparepart'])->name('storeSparepart');
        });

        // Manager & Technician Routes
        Route::middleware(RoleMiddleware::class . ':Manager,Technician')->group(function () {
            Route::get('/service-history', [ServiceController::class, 'view'])->name('serviceHistory');
            Route::post('/service-history', [ServiceController::class, 'edit'])->name('service.edit');
            Route::get('/booking-list', [BookingController::class, 'index'])->name('bookingList');
        });

        // Manager-only Routes
        Route::middleware(RoleMiddleware::class . ':Manager')->group(function () {
            Route::get('/admins', [AdminController::class, 'allAdmins'])->name('all');
            Route::post('/admins', [AdminController::class, 'store'])->name('storeAdmin');
            Route::post('/admins/update', [AdminController::class, 'update'])->name('updateAdmin');
            Route::post('/admins/delete', [AdminController::class, 'destroy'])->name('deleteAdmin');
        });
    });
});

// Fallback Route
Route::fallback(function () {
    return redirect()->route('user.home');
});