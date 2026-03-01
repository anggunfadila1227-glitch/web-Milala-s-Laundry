<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
<<<<<<< HEAD
     * LIST DATA LAYANAN
=======
     * ==========================
     * TAMPILKAN DATA LAYANAN
     * ==========================
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function index()
    {
        $layanans = Layanan::latest()->get();
<<<<<<< HEAD
=======

>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
        return view('admin.layanan.index', compact('layanans'));
    }

    /**
<<<<<<< HEAD
     * FORM TAMBAH LAYANAN
=======
     * ==========================
     * FORM TAMBAH LAYANAN
     * ==========================
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
<<<<<<< HEAD
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
=======
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

>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
<<<<<<< HEAD
     * FORM EDIT LAYANAN
=======
     * ==========================
     * FORM EDIT
     * ==========================
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
<<<<<<< HEAD
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
=======
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
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    /**
<<<<<<< HEAD
     * HAPUS LAYANAN
=======
     * ==========================
     * HAPUS DATA
     * ==========================
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
}
