<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Admin\PesananAdminController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------
    | TRANSAKSI CUSTOMER (INI PENTING)
    |--------------------------------------------------
    */
    Route::prefix('transaksi')->name('transaksi.')->group(function () {

        // LIST
        Route::get('/', [TransaksiController::class, 'index'])
            ->name('index');

        // FORM TAMBAH (DROPDOWN ADA DI SINI)
        Route::get('/create', [TransaksiController::class, 'create'])
            ->name('create');

        // SIMPAN
        Route::post('/', [TransaksiController::class, 'store'])
            ->name('store');

        // DETAIL
        Route::get('/{transaksi}', [TransaksiController::class, 'show'])
            ->name('show');
    });

    // ================= PEMBAYARAN CUSTOMER =================
    Route::get('/pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    // ================= ADMIN =================
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // MASTER LAYANAN
        Route::resource('layanan', LayananController::class);

        // TRANSAKSI ADMIN
        Route::resource('transaksi', AdminTransaksiController::class);

        // PESANAN
        Route::get('/pesanan', [PesananAdminController::class, 'index'])
            ->name('pesanan');

        Route::post('/pesanan/{id}/status', [PesananAdminController::class, 'updateStatus'])
            ->name('pesanan.status');

        // PEMBAYARAN ADMIN
        Route::post('/pembayaran/{id}/bayar', [AdminPembayaranController::class, 'bayar'])
            ->name('pembayaran.bayar');

        Route::resource('pembayaran', AdminPembayaranController::class)
            ->only(['index', 'show']);

        // STRUK
        Route::get('/pesanan/{id}/struk', [AdminPembayaranController::class, 'struk'])
            ->name('struk');

        Route::get('/pesanan/{id}/struk-pdf', [StrukController::class, 'pdf'])
            ->name('struk.pdf');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan');
    });
});
