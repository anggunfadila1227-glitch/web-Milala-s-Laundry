<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // =========================
    // TAMPILKAN DATA LAYANAN
    // =========================
    public function index()
    {
        $layanans = Layanan::latest()->get();

        return view('admin.layanan.index', compact('layanans'));
    }

    // =========================
    // FORM TAMBAH LAYANAN
    // =========================
    public function create()
    {
        return view('admin.layanan.create');
    }

    // =========================
    // SIMPAN DATA LAYANAN
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan'  => 'required',
            'jenis_cucian'  => 'required',
            'harga'         => 'required|numeric',
        ]);

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'jenis_cucian' => $request->jenis_cucian,
            'harga'        => $request->harga,
        ]);

        return redirect('/admin/layanan')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    // =========================
    // FORM EDIT LAYANAN
    // =========================
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.layanan.edit', compact('layanan'));
    }

    // =========================
    // UPDATE DATA LAYANAN
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan'  => 'required',
            'jenis_cucian'  => 'required',
            'harga'         => 'required|numeric',
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'jenis_cucian' => $request->jenis_cucian,
            'harga'        => $request->harga,
        ]);

        return redirect('/admin/layanan')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    // =========================
    // HAPUS LAYANAN
    // =========================
    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();

        return redirect('/admin/layanan')
            ->with('success', 'Layanan berhasil dihapus');
    }
}