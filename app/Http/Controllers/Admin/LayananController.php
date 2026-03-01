<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * LIST DATA LAYANAN
     */
    public function index()
    {
        $layanans = Layanan::latest()->get();
        return view('admin.layanan.index', compact('layanans'));
    }

    /**
     * FORM TAMBAH LAYANAN
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * SIMPAN LAYANAN BARU
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'jenis_cucian' => 'required|string',
            'jenis_layanan' => 'required|string',
            'harga'        => 'required|numeric',
            'status'       => 'required|string',
            'deskripsi'    => 'nullable|string',
        ]);

        Layanan::create($validated);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * FORM EDIT LAYANAN
     */
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * UPDATE DATA LAYANAN
     */
    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
        'nama_layanan' => 'required|string|max:255',
        'jenis_cucian' => 'required|string',
        'jenis_layanan' => 'required|string', 
        'harga'        => 'required|numeric',
        'status'       => 'required|string',
        'deskripsi'    => 'nullable|string',
    ]);

        $layanan->update($validated);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * HAPUS LAYANAN
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
}
