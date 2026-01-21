<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Layanan;
use App\Models\AddJenisCucian;

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
    $jenisCucians = AddJenisCucian::all(); // ✅ data dropdown jenis cucian

    return view('transaksi.create', compact('layanans', 'jenisCucians'));
}



    // simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.layanan_id' => 'required|exists:layanans,id',
            'items.*.jenis_cucian_id' => 'required|exists:add_jenis_cucian,id',
            'items.*.qty' => 'required|numeric|min:0.1',
            'catatan' => 'nullable|string',
        ]);

        $kode_transaksi = 'TX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'catatan' => $request->catatan,
            'total' => 0,
            'tanggal_masuk' => now(),
        ]);

        $total = 0;

        foreach ($request->items as $item) {

            // pakai firstOrFail supaya tidak null
            $layanan = Layanan::where('id', $item['layanan_id'])->firstOrFail();
            $jenisCucian = AddJenisCucian::where('id', $item['jenis_cucian_id'])->firstOrFail();

            $qty = $item['qty'];
            $subtotal = $layanan->harga * $qty;

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'layanan_id' => $layanan->id,
                'jenis_cucian' => $jenisCucian->id, // ✅ aman
                'qty' => $qty,
                'harga' => $layanan->harga,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $transaksi->update(['total' => $total]);

        return redirect()
            ->route('transaksi.index')
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
