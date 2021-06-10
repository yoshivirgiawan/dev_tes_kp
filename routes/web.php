<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/create', [HomeController::class, 'store'])->name('create');
Route::get('{task:id}/edit', [HomeController::class, 'edit'])->name('edit');
Route::patch('{task:id}/update', [HomeController::class, 'update'])->name('update');
Route::delete('{task:id}/delete', [HomeController::class, 'destroy'])->name('delete');
