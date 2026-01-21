<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Layanan;

class TransaksiController extends Controller
{
    /**
     * Tampilkan semua transaksi (ADMIN)
     * GET /admin/transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::with(['user'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Detail transaksi
     * GET /admin/transaksi/{transaksi}
     */
        public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'details.layanan'])
            ->findOrFail($id);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Form edit status transaksi (opsional)
     * GET /admin/transaksi/{transaksi}/edit
     */
    public function edit(Transaksi $transaksi)
    {
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update status transaksi
     * PUT /admin/transaksi/{transaksi}
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
     * Hapus transaksi (JARANG dipakai)
     * DELETE /admin/transaksi/{transaksi}
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
