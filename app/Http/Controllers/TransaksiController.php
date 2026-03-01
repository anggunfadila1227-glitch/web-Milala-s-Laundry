<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Layanan;
<<<<<<< HEAD
use App\Models\JenisCucian;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
=======
use App\Models\AddJenisCucian;
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

class TransaksiController extends Controller
{
    // ===============================
    // LIST TRANSAKSI USER
    // ===============================
        
    
        public function index()
    {
        $transaksis = Transaksi::with([
                'details.layanan',
                'details.jenisCucian'
            ])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaksi.index', compact('transaksis'));
    }
    

<<<<<<< HEAD
    



    // ===============================
    // FORM BUAT TRANSAKSI
    // ===============================
    public function create()
    {
        $layanans = Layanan::all();
        $jenisCucians = JenisCucian::all();

        return view('transaksi.create', compact('layanans', 'jenisCucians'));
    }
=======
    // form buat transaksi baru
public function create()
{
    $layanans = Layanan::all();
    $jenisCucians = AddJenisCucian::all(); // ✅ data dropdown jenis cucian

    return view('transaksi.create', compact('layanans', 'jenisCucians'));
}


>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

    // ===============================
    // SIMPAN TRANSAKSI
    // ===============================
        public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.layanan_id' => 'required|exists:layanans,id',
<<<<<<< HEAD
            'items.*.jenis_cucian_id' => 'required|exists:jenis_cucians,id',
=======
            'items.*.jenis_cucian_id' => 'required|exists:add_jenis_cucian,id',
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
            'items.*.qty' => 'required|numeric|min:0.1',
        ]);

<<<<<<< HEAD
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'status' => 'menunggu',              // proses laundry
            'status_pembayaran' => 'belum_lunas',// pembayaran
            'total' => 0,
=======
        $kode_transaksi = 'TX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'catatan' => $request->catatan,
            'total' => 0,
            'tanggal_masuk' => now(),
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
        ]);

            $total = 0;

<<<<<<< HEAD
            foreach ($request->items as $item) {

                $layanan = Layanan::findOrFail($item['layanan_id']);
=======
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
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

                $harga = $layanan->harga;
                $subtotal = $item['qty'] * $harga;

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'layanan_id' => $item['layanan_id'],          // ✅ FIX
                    'jenis_cucian_id' => $item['jenis_cucian_id'],// ✅ FIX
                    'qty' => $item['qty'],                        // ✅ FIX
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $transaksi->update(['total' => $total]);

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
<<<<<<< HEAD
=======

        $transaksi->update(['total' => $total]);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat!');
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
    }

        // ===============================
        // DETAIL TRANSAKSI
        // ===============================
        public function show($id)
        {
            $transaksi = Transaksi::with([
                    'details.layanan',
                    'details.jenisCucian'
                ])
                ->where('user_id', Auth::id())
                ->findOrFail($id);

            return view('transaksi.show', compact('transaksi'));
        }
    }
<<<<<<< HEAD
=======
}
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
