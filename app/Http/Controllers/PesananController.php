<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Tampilkan daftar pesanan customer
     */
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pesanan.index', compact('pesanans'));
    }

    /**
     * Form buat pesanan
     */
    public function create()
    {
        $layanans = Layanan::all();
        return view('pesanan.create', compact('layanans'));
    }

    /**
     * Simpan pesanan
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id'   => 'required',
            'jenis_cucian' => 'required',
            'berat'        => 'required|numeric|min:1',
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);
        $tanggalMasuk = now();
        $estimasi = now()->addDays(2);

        $total = $request->berat * $layanan->harga;

        Pesanan::create([
            'user_id' => Auth::id(),
            'layanan_id' => $layanan->id,
            'jenis_cucian' => $request->jenis_cucian,
            'berat' => $request->berat,
            'tanggal_masuk' => $tanggalMasuk,
            'estimasi_selesai' => $estimasi,
            'catatan' => $request->catatan,
            'total' => $total,
            'status' => 'proses',
        ]);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Pesanan berhasil dibuat 💜');
    }
}