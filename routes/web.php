<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\ProjectIdController;
use App\Http\Controllers\MasterController;

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
});
