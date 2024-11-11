<?php

use App\Http\Controllers\DashboardController;
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
Route::get('/data_project', [MasterController::class, 'data_project'])->name('data_project');
Route::get('/data_client', [MasterController::class, 'data_client'])->name('data_client');
Route::get('/data_vendor', [MasterController::class, 'data_vendor'])->name('data_vendor');
Route::get('/data_bank', [MasterController::class, 'data_bank'])->name('data_bank');
