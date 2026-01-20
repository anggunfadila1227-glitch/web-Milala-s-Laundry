<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Tampilkan semua layanan
     */
    public function index()
    {
        $layanans = Layanan::orderBy('created_at', 'desc')->get();

        return view('admin.layanan.index', compact('layanans'));
    }

    /**
     * Form tambah layanan
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Simpan layanan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan'  => 'required|string|max:100',
            'jenis_cucian'  => 'required|string|max:100',
            'harga'         => 'required|numeric|min:0',
        ]);

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'jenis_cucian' => $request->jenis_cucian,
            'harga'        => $request->harga,
        ]);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * Form edit layanan
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update layanan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'jenis_cucian' => 'required|string|max:100',
            'harga'        => 'required|numeric|min:0',
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'jenis_cucian' => $request->jenis_cucian,
            'harga'        => $request->harga,
        ]);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Hapus layanan
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
}