<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController; // Controller customer
use App\Http\Controllers\Admin\PesananAdminController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController; // Controller admin
use App\Http\Controllers\Admin\StrukController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| AREA LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ================= CUSTOMER =================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('transaksi', TransaksiController::class)
        ->only(['index', 'create', 'store', 'show']);

    Route::get('/pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    // ================= ADMIN =================
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

        // DASHBOARD ADMIN
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // LAYANAN ADMIN (FULL CRUD)
        Route::resource('layanan', LayananController::class);

        // TRANSAKSI ADMIN
        Route::resource('transaksi', AdminTransaksiController::class);

        // PESANAN ADMIN
        Route::get('/pesanan', [PesananAdminController::class, 'index'])->name('pesanan');
        Route::post('/pesanan/{id}/status', [PesananAdminController::class, 'updateStatus'])->name('pesanan.status');

        // PEMBAYARAN ADMIN
        // 1️⃣ POST route bayar transaksi harus sebelum resource
        Route::post('/pembayaran/{id}/bayar', [AdminPembayaranController::class, 'bayar'])
            ->name('pembayaran.bayar');

        // 2️⃣ Resource pembayaran (hanya index & show)
        Route::resource('pembayaran', AdminPembayaranController::class)
            ->only(['index', 'show'])
            ->names([
                'index' => 'pembayaran.index',
                'show'  => 'pembayaran.show',
            ]);

        // STRUK
        Route::get('/pesanan/{id}/struk', [AdminPembayaranController::class, 'struk'])->name('struk');
        Route::get('/pesanan/{id}/struk-pdf', [StrukController::class, 'pdf'])->name('struk.pdf');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    });
});
