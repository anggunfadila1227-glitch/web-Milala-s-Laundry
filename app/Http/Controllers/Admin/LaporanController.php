<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil transaksi yang sudah LUNAS
        $transaksis = Transaksi::with(['user', 'details'])
            ->where('status', 'LUNAS')
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung total pendapatan dari detail transaksi
        $totalPendapatan = $transaksis->sum(function ($transaksi) {
            return $transaksi->details->sum(function ($detail) {
                return ($detail->harga ?? 0) * ($detail->qty ?? 0);
            });
        });

        return view('admin.laporan', compact(
            'transaksis',
            'totalPendapatan'
        ));
    }
}
