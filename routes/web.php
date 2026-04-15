<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- */

Route::get('/', function () {
    return view('welcome');
});

// ADMIN PANEL
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class , 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('doctors', DoctorController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('transactions', TransactionController::class);
});
