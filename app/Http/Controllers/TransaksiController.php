<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Layanan;

class TransaksiController extends Controller
{
    // menampilkan semua transaksi customer
    public function index()
    {
        $transaksis = Transaksi::with('details.layanan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksis'));
    }

    // form buat transaksi baru
    public function create()
    {
        $layanans = Layanan::all();
        return view('transaksi.create', compact('layanans'));
    }

    // simpan transaksi baru
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'items.*.layanan_id' => 'required|exists:layanans,id',
            'items.*.qty' => 'required|numeric|min:0.1',
            'catatan' => 'nullable|string',
        ]);

        // generate kode transaksi unik
        $kode_transaksi = 'TX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        // buat transaksi baru
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'catatan' => $request->catatan ?? null,
            'total' => 0, // sementara
        ]);

        $total = 0;

        // simpan detail tiap layanan
        foreach ($request->items as $item) {
            $layanan = Layanan::find($item['layanan_id']);
            $qty = $item['qty'];
            $subtotal = $layanan->harga * $qty;

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'layanan_id' => $layanan->id,
                'jenis_cucian' => $layanan->jenis_cucian,
                'qty' => $qty,
                'harga' => $layanan->harga,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        // update total transaksi
        $transaksi->update(['total' => $total]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat!');
    }

    // tampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('details.layanan')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('transaksi.show', compact('transaksi'));
    }
}