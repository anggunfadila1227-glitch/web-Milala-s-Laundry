<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Tampilkan daftar transaksi untuk pembayaran
     */
    public function index()
    {
        // Ambil semua transaksi yang belum dibayar
        // Bisa ditambah filter admin/customer jika perlu
        $transaksis = Transaksi::with('user', 'details.layanan')
            ->where('status', '!=', 'batal') // semua transaksi kecuali dibatalkan
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('transaksis'));
    }

    /**
     * Tandai transaksi sudah dibayar
     */
 public function bayar($id)
{
    $transaksi = Transaksi::findOrFail($id);

    // Gunakan value ENUM yang valid
    $transaksi->status = 'lunas';
    $transaksi->save();

    return redirect()->route('admin.pembayaran.index')
                     ->with('success', 'Pembayaran berhasil!');
}



    /**
     * Tampilkan struk pembayaran (HTML)
     */
    public function struk($id)
    {
        $transaksi = Transaksi::with('details.layanan', 'user')
                        ->findOrFail($id);

        return view('admin.pembayaran.struk', compact('transaksi'));
    }
}