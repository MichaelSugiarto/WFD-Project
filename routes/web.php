<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\SparepartController;
use App\Http\Controllers\ServiceController;

// user
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/book', [UserController::class, 'book'])->name('book');
    Route::post('/book', [UserController::class, 'storeBooking'])->name('booking.store');
    Route::get('/history', [UserController::class, 'history'])->name('history');
});


//admin (nanti diubah kalau sudah ada login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [SparepartController::class, 'view'])->name('allSparepart'); 
    Route::post('/store-sparepart', [SparepartController::class, 'storeSparepart'])->name('storeSparepart');

    Route::get('/service-history', [ServiceController::class, 'view'])->name('serviceHistory');
});

Route::fallback(function () {
    return redirect()->route('user.home');
});