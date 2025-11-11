<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [BukuController::class, 'lp'])->name('books.index');
Route::view('/about', 'public.about')->name('about');
Route::view('/service', 'public.service')->name('service');
Route::view('/contact', 'public.contact')->name('contact');
Route::get('/profile', function () {return view('public.profile');})->middleware('auth')->name('profile');
Route::get('/books', [BukuController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BukuController::class, 'show'])->name('books.show');
/*
/--------------------------------------------------------------------------
/ Authentication Routes
/--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Google OAuth
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboardadmin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/notifikasiadmin', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');
    Route::get('/pengaturanadmin', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');

    // buku
    Route::get('/bukutambah', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/bukutambah', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/bukuadmin', [BukuController::class, 'admin'])->name('buku.index');
    Route::get('/bukuadmin/{id}', [BukuController::class, 'show'])->name('buku.show');
    Route::get('/bukuadmin/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::delete('/bukuadmin/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');



    // Anggota
    Route::get('/anggotaadmin', [AdminController::class, 'anggota'])->name('admin.anggota');
    Route::get('/anggotatambah', [AdminController::class, 'anggotaTambah'])->name('anggota.tambah');

    // Transaksi
    Route::get('/transaksiadmin', [TransactionController::class, 'index']);
    Route::get('/transaksitambah', [TransactionController::class, 'create']);
    Route::post('/transaksitambah', [TransactionController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}', [TransactionController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransactionController::class, 'destroy']);
});
