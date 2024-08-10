<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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
    Route::get('/', function () {
        $title = 'Dashboard';
        return view('dashboard.index', compact('title'));
    })->name('dashboard');
    // Category routes
    Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/kategori/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/kategori/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/kategori/cek-slug', [CategoryController::class, 'checkSlug'])->name('categories.checkSlug');
    Route::get('/kategori/{slug}', [CategoryController::class, 'getCategory'])->name('categories.find');
    // Book routes
    Route::get('/buku', [BookController::class, 'index'])->name('books.index');
    Route::get('/buku/{slug}/download', [BookController::class, 'download'])->name('books.download');
    Route::get('/buku/tambah', [BookController::class, 'create'])->name('books.create');
    Route::post('/buku/tambah', [BookController::class, 'store'])->name('books.store');
});
