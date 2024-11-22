<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\ProjectIdController;
use App\Http\Controllers\Master\DataClientController;
use App\Http\Controllers\Master\BankController;
use App\Http\Controllers\Master\DataVendorController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SphController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return redirect(route('dashboard'));
});
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    // dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Master
    Route::get('project-id', [ProjectIdController::class, 'index'])->name('project-id');
    Route::post('project-id', [ProjectIdController::class, 'store'])->name('project-id.store');
    Route::get('project-id/{id}/edit', [ProjectIdController::class, 'edit'])->name('project-id.edit');
    Route::put('project-id/{id}', [ProjectIdController::class, 'update'])->name('project-id.update');
    Route::delete('project-id/delete/{id}', [ProjectIdController::class, 'delete'])->name('project-id.delete');

    Route::get('data-client', [DataClientController::class, 'index'])->name('data-client');
    Route::post('data-client', [DataClientController::class, 'store'])->name('data-client.store');
    Route::get('data-client/{id}/edit', [DataClientController::class, 'edit'])->name('data-client.edit');
    Route::put('data-client/{id}', [DataClientController::class, 'update'])->name('data-client.update');
    Route::delete('data-client/delete/{id}', [DataClientController::class, 'destroy'])->name('data-client.delete');

    Route::get('bank', [BankController::class, 'index'])->name('bank');
    Route::post('bank', [BankController::class, 'store'])->name('bank.store');
    Route::get('bank/{id}/edit', [BankController::class, 'edit'])->name('bank.edit');
    Route::put('bank/{id}', [BankController::class, 'update'])->name('bank.update');
    Route::delete('bank/delete/{id}', [BankController::class, 'destroy'])->name('bank.delete');

    Route::get('data-vendor', [DataVendorController::class, 'index'])->name('data-vendor');
    Route::post('data-vendor', [DataVendorController::class, 'store'])->name('data-vendor.store');
    Route::get('data-vendor/{id}/edit', [DataVendorController::class, 'edit'])->name('data-vendor.edit');
    Route::put('data-vendor/{id}', [DataVendorController::class, 'update'])->name('data-vendor.update');
    Route::delete('data-vendor/delete/{id}', [DataVendorController::class, 'delete'])->name('data-vendor.delete');

    Route::get('po', [PurchaseOrderController::class, 'index'])->name('po');
    Route::post('po', [PurchaseOrderController::class, 'store'])->name('po.store');
    Route::get('po/{id}/edit', [PurchaseOrderController::class, 'edit'])->name('po.edit');
    Route::put('po/{id}', [PurchaseOrderController::class, 'update'])->name('po.update');
    Route::delete('po/delete/{id}', [PurchaseOrderController::class, 'delete'])->name('po.delete');

    // sph
    Route::get('data-sph', [SphController::class, 'index'])->name('data-sph');
    Route::post('data-sph', [SphController::class, 'store'])->name('data-sph.store');
    Route::get('data-sph/{id}/edit', [SphController::class, 'edit'])->name('data-sph.edit');
    Route::put('data-sph/{id}', [SphController::class, 'update'])->name('data-sph.update');
    Route::delete('data-sph/delete/{id}', [SphController::class, 'delete'])->name('data-sph.delete');
});

