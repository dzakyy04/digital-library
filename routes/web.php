<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/dashboard/kategori', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/dashboard/kategori', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/dashboard/kategori/{slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/dashboard/kategori/cek-slug', [CategoryController::class, 'checkSlug'])->name('categories.checkSlug');
Route::get('/dashboard/kategori/{slug}', [CategoryController::class, 'getCategory'])->name('categories.find');
