<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ActivityController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [BukuController::class, 'lp'])->name('books.index');
Route::view('/about', 'public.about')->name('about');
Route::view('/service', 'public.service')->name('service');
Route::view('/contact', 'public.contact')->name('contact');
Route::get('/books', [BukuController::class, 'index'])->name('books.index');
Route::get('/buku/{id}', [BukuController::class, 'showlp'])->name('buku.showlp');
Route::get('/buku/{id}/download', [BukuController::class, 'downloadEbook'])->name('buku.download');
Route::post('/book/{id}/borrow', [TransactionController::class, 'borrow']);
Route::get('/activity', [TransactionController::class, 'activity'])->name('activity.index')->middleware('auth');
Route::post('/activity/{transaction}/return', [TransactionController::class, 'userReturn'])->name('activity.return');

// API Notifications
Route::get('/api/notifications', function () {
    if (!auth()->check()) {
        return response()->json([]);
    }
    return response()->json(auth()->user()->notifications()->latest()->take(5)->get());
})->middleware('auth')->name('api.notifications');

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
    Route::put('/bukuadmin/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/bukuadmin/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');



    // Anggota
    Route::resource('/anggotaadmin', AnggotaController::class);

    // List transaksi
    Route::get('/transaksiadmin', [TransactionController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksitambah', [TransactionController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksiadmin', [TransactionController::class, 'store'])->name('transaksi.store');
    Route::post('/admin/transaksi/pinjam/{user}/{book}', [TransactionController::class, 'pinjam'])
        ->name('transaksi.pinjam');
    Route::post('/admin/transaksi/kembalikan/{id}', [TransactionController::class, 'kembalikan'])
        ->name('transaksi.kembalikan');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {return view('public.profile');})->middleware('auth')->name('profile');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
}); 