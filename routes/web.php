<?php

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
    return view('welcome');
});

// ADMIN
Route::get('/admin/{kategori}', function($kategori) {
    if ($kategori == "categories") {
        return view('admin.categories');
    }
    else if ($kategori == "order") {
        return view('admin.orders');
    }
    else {
        return view('admin.members');
    }
});
