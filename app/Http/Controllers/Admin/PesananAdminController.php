<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananAdminController extends Controller
{
    // 1️⃣ Menampilkan semua pesanan
    public function index()
    {
        $pesanans = Pesanan::with('user')->orderBy('tanggal_masuk', 'desc')->get();
        return view('admin.pesanan', compact('pesanans'));
    }

    // 2️⃣ Ubah status pesanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diupdate.');
    }

    // 3️⃣ **Laporan transaksi** ← ini tempat method laporan()
    public function laporan()
    {
        // ambil semua pesanan yang sudah selesai
        $pesanans = Pesanan::where('status','selesai')->get();

        // total pendapatan
        $total = $pesanans->sum('total');

        // kirim ke view admin.laporan
        return view('admin.laporan', compact('pesanans','total'));
    }
}