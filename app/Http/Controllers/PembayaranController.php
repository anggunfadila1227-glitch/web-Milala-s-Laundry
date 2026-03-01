<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class PembayaranController extends Controller
{
    /**
     * Tampilkan halaman pembayaran customer
     */
    public function index()
    {
        // Ambil transaksi milik user yang login
      $transaksis = Transaksi::where('user_id', Auth::id() ?? 0)->get();
        return view('pembayaran.index', compact('transaksis'));
    }
}
