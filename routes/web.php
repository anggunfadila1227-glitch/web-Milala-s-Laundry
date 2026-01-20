<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

use App\Http\Controllers\Admin\PesananAdminController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\StrukController;

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

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');


    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        // DASHBOARD
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // LAYANAN
        Route::resource('layanan', LayananController::class);

        // PESANAN
        Route::get('/pesanan', [PesananAdminController::class, 'index'])
            ->name('pesanan');

        Route::post('/pesanan/{id}/status',
            [PesananAdminController::class, 'updateStatus']
        )->name('pesanan.status');

        // PEMBAYARAN
        Route::get('/pembayaran', [PembayaranController::class, 'index'])
            ->name('pembayaran');

        // STRUK
        Route::get('/pesanan/{id}/struk',
            [PembayaranController::class, 'struk']
        )->name('struk');

        Route::get('/pesanan/{id}/struk-pdf',
            [StrukController::class, 'pdf']
        )->name('struk.pdf');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan');
    });
});