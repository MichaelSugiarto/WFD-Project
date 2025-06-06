<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\SparepartController;
use App\Http\Controllers\ServiceController;

//user
Route::get('/', [UserController::class, 'index'])->name('user.home'); 




//admin (nanti diubah kalau sudah ada login)
Route::prefix('admin')->group(function () {
    Route::get('/', [SparepartController::class, 'view'])->name('admin.allSparepart'); 
    Route::post('/store-sparepart', [SparepartController::class, 'storeSparepart'])->name('admin.storeSparepart');

    Route::get('/service-history', [ServiceController::class, 'view'])->name('admin.serviceHistory'); 
});