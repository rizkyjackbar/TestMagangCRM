<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WashController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

// Route halaman utama
Route::get('/', [WashController::class, 'index'])->name('home');

// Route transaksi
Route::post('/transaction', [WashController::class, 'store'])->name('transaction.store');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

// Route riwayat
Route::get('/history', [WashController::class, 'history'])->name('transaction.history');

// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Login
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    // Customer CRUD routes
    Route::post('/customers/store', [AdminController::class, 'storeCustomer'])->name('admin.customers.store');
    Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('admin.customers.edit');
    Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('admin.customers.update');
    Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.customers.delete');

    // Vehicle CRUD routes
    Route::post('/vehicles/store', [AdminController::class, 'storeVehicle'])->name('admin.vehicles.store');
    Route::get('/vehicles/{id}/edit', [AdminController::class, 'editVehicle'])->name('admin.vehicles.edit');
    Route::put('/vehicles/{id}', [AdminController::class, 'updateVehicle'])->name('admin.vehicles.update');
    Route::delete('/vehicles/{id}', [AdminController::class, 'deleteVehicle'])->name('admin.vehicles.delete');
});
