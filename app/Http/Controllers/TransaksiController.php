<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Layanan;
use App\Models\JenisCucian;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
    

    



    // ===============================
    // FORM BUAT TRANSAKSI
    // ===============================
    public function create()
    {
        $layanans = Layanan::all();
        $jenisCucians = JenisCucian::all();

        return view('transaksi.create', compact('layanans', 'jenisCucians'));
    }

    // ===============================
    // SIMPAN TRANSAKSI
    // ===============================
        public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.layanan_id' => 'required|exists:layanans,id',
            'items.*.jenis_cucian_id' => 'required|exists:jenis_cucians,id',
            'items.*.qty' => 'required|numeric|min:0.1',
        ]);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'status' => 'menunggu',              // proses laundry
            'status_pembayaran' => 'belum_lunas',// pembayaran
            'total' => 0,
        ]);

            $total = 0;

            foreach ($request->items as $item) {

                $layanan = Layanan::findOrFail($item['layanan_id']);

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
