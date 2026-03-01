<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
<<<<<<< HEAD
=======
use App\Models\DetailTransaksi;
use App\Models\Layanan;
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

class TransaksiController extends Controller
{
    /**
     * Tampilkan semua transaksi (ADMIN)
<<<<<<< HEAD
     */
    public function index()
    {
        $transaksis = Transaksi::with([
            'user',
            'details' => function ($query) {
                $query->whereNotNull('layanan_id');
            },
            'details.layanan',
        ])
        ->orderBy('created_at', 'desc')
        ->get();
=======
     * GET /admin/transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::with(['user'])
            ->latest()
            ->get();
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Detail transaksi
<<<<<<< HEAD
     */
    public function show($id)
    {
        $transaksi = Transaksi::with([
            'user',
            'details' => function ($query) {
                $query->whereNotNull('layanan_id');
            },
            'details.layanan',
        ])->findOrFail($id);
=======
     * GET /admin/transaksi/{transaksi}
     */
        public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'details.layanan'])
            ->findOrFail($id);
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
<<<<<<< HEAD
     * Form edit status transaksi
=======
     * Form edit status transaksi (opsional)
     * GET /admin/transaksi/{transaksi}/edit
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function edit(Transaksi $transaksi)
    {
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update status transaksi
<<<<<<< HEAD
=======
     * PUT /admin/transaksi/{transaksi}
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $transaksi->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Status transaksi berhasil diperbarui');
    }

    /**
<<<<<<< HEAD
     * Hapus transaksi
=======
     * Hapus transaksi (JARANG dipakai)
     * DELETE /admin/transaksi/{transaksi}
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
