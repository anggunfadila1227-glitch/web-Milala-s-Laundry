<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Tampilkan semua transaksi (ADMIN)
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

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Detail transaksi
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

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Form edit status transaksi
     */
    public function edit(Transaksi $transaksi)
    {
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update status transaksi
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
     * Hapus transaksi
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
