<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class LaporanController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::orderBy('tanggal_masuk', 'desc')->get();
        $totalPendapatan = Pesanan::sum('total');

        return view('admin.laporan', compact('pesanans', 'totalPendapatan'));
    }
}
