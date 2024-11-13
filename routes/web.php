<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\ProjectIdController;
use App\Http\Controllers\Master\DataClientController;
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

Route::get('/', function () {
    return view('login');
});
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Master
Route::get('project-id', [ProjectIdController::class, 'index'])->name('project-id');
Route::post('project-id', [ProjectIdController::class, 'store'])->name('project-id.store');
Route::delete('project-id/delete/{id}', [ProjectIdController::class, 'delete'])->name('project-id.delete');

Route::get('data-client', [DataClientController::class, 'index'])->name('data-client');
Route::post('data-client', [DataClientController::class, 'store'])->name('data-client.store');
Route::delete('data-client/delete/{id}', [DataClientController::class, 'destroy'])->name('data-client.delete');


