<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi milik user yang login
        $transaksis = Transaksi::with('details.layanan')
                        ->where('user_id', Auth::id())
                        ->where('status', '!=', 'batal')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('customer.pembayaran.index', compact('transaksis'));
    }
}