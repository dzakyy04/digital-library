<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookExportController;
use App\Http\Controllers\DashboardController;

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
    return redirect()->route('login.view');
});

Route::middleware('guest')->group(function () {
    // Register routes
    Route::get('/daftar', [AuthController::class, 'showRegisterForm'])->name('register.view');
    Route::post('/daftar', [AuthController::class, 'register'])->name('register');

    // Login routes
    Route::get('/masuk', [AuthController::class, 'showLoginForm'])->name('login.view');
    Route::post('/masuk', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Category routes
    Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/kategori/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/kategori/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/kategori/cek-slug', [CategoryController::class, 'checkSlug'])->name('categories.checkSlug');
    Route::get('/kategori/{slug}', [CategoryController::class, 'getCategory'])->name('categories.find');

    // Book routes
    Route::get('/buku', [BookController::class, 'index'])->name('books.index');
    Route::get('/semua-buku', [BookController::class, 'all'])->name('books.all');
    Route::get('/buku/{slug}/download', [BookController::class, 'download'])->name('books.download');
    Route::get('/buku/tambah', [BookController::class, 'create'])->name('books.create');
    Route::post('/buku/tambah', [BookController::class, 'store'])->name('books.store');
    Route::get('/buku/{slug}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/buku/{slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/buku/{slug}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/buku/{slug}', [BookController::class, 'getBook'])->name('books.find');
    Route::get('/buku/export/pdf', [BookExportController::class, 'exportMyBooksPdf'])->name('books.export.pdf');
    Route::get('/buku/export/pdf/semua', [BookExportController::class, 'exportAllBooksPdf'])->name('books.export.all.pdf');
    Route::get('/buku/export/pdf-table', [BookExportController::class, 'exportMyBooksPdfTable'])->name('books.export.pdf.table');
    Route::get('/buku/export/pdf-table/semua', [BookExportController::class, 'exportAllBooksPdfTable'])->name('books.export.all.pdf.table');
    Route::get('/buku/export/excel', [BookExportController::class, 'exportMyBooksExcel'])->name('books.export.excel');
    Route::get('/buku/export/excel/semua', [BookExportController::class, 'exportAllBooksExcel'])->name('books.export.all.excel');
});
