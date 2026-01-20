@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    👕 Buat Pesanan Laundry
</h1>

<form action="{{ route('pesanan.store') }}" method="POST"
      class="bg-white rounded-2xl shadow p-6 max-w-xl space-y-5">

    @csrf

    <!-- PILIH LAYANAN -->
    <div>
        <label class="block font-semibold mb-1 text-gray-700">
            Pilih Layanan
        </label>

        <select name="layanan_id"
                class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400"
                required>

            <option value="">-- Pilih Layanan --</option>

            @foreach ($layanans as $layanan)
                <option value="{{ $layanan->id }}">
                    {{ $layanan->nama }} — Rp {{ number_format($layanan->harga) }}/kg
                </option>
            @endforeach
        </select>
    </div>

    <!-- JENIS CUCIAN -->
    <div>
        <label class="block font-semibold mb-1 text-gray-700">
            Jenis Cucian
        </label>

        <select name="jenis_cucian"
                class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">

            <option value="Pakaian">Pakaian</option>
            <option value="Selimut">Selimut</option>
            <option value="Bed Cover">Bed Cover</option>
            <option value="Karpet">Karpet</option>
        </select>
    </div>

    <!-- BERAT -->
    <div>
        <label class="block font-semibold mb-1 text-gray-700">
            Berat Cucian (kg)
        </label>

        <input type="number"
               name="berat"
               min="1"
               placeholder="Contoh: 3"
               class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400"
               required>
    </div>

    <!-- CATATAN -->
    <div>
        <label class="block font-semibold mb-1 text-gray-700">
            Catatan (opsional)
        </label>

        <textarea name="catatan"
                  rows="3"
                  placeholder="Contoh: jangan dicampur warna"
                  class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400"></textarea>
    </div>

    <!-- BUTTON -->
    <button type="submit"
        class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-xl font-semibold transition duration-200">
        💾 Simpan Pesanan
    </button>

</form>

@endsection