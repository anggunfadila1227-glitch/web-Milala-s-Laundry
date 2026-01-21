<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * ==========================
     * TAMPILKAN DATA LAYANAN
     * ==========================
     */
    public function index()
    {
        $layanans = Layanan::latest()->get();

        return view('admin.layanan.index', compact('layanans'));
    }

    /**
     * ==========================
     * FORM TAMBAH LAYANAN
     * ==========================
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * ==========================
     * SIMPAN DATA
     * ==========================
     */
    public function store(Request $request)
    {
$request->validate([
    'nama_layanan' => 'required|string',
    'jenis_layanan' => 'required|string',
    'jenis_cucian' => 'required|string',
    'harga' => 'required|numeric',
    'status' => 'required'
]);

Layanan::create([
    'nama_layanan'   => $request->nama_layanan,
    'jenis_layanan'  => $request->jenis_layanan, // ✅ WAJIB
    'jenis_cucian'   => $request->jenis_cucian,
    'harga'          => $request->harga,
    'status'         => $request->status,
]);


        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * ==========================
     * FORM EDIT
     * ==========================
     */
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * ==========================
     * UPDATE DATA
     * ==========================
     */
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama_layanan'  => 'required|string|max:100',
            'jenis_cucian'  => 'required|string|max:50',
            'harga'         => 'required|numeric|min:0',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'jenis_cucian' => $request->jenis_cucian,
            'harga'        => $request->harga,
            'status'       => $request->status,
        ]);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * ==========================
     * HAPUS DATA
     * ==========================
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
}