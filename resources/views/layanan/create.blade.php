@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    ➕ Buat Transaksi Laundry
</h1>

<form action="{{ route('transaksi.store') }}" method="POST"
      class="space-y-6">

    @csrf

    <!-- PILIH LAYANAN -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">
            Pilih Layanan
        </label>

        <select name="layanan_id"
            class="w-full px-4 py-2 rounded-lg border bg-black text-info-800
                   focus:outline-none focus:ring-2 focus:ring-purple-500">

            <option value="">-- Pilih Layanan --</option>

            @foreach ($layanans as $layanan)
                <option value="{{ $layanan->id }}">
                    {{ $layanan->nama_layanan }} - Rp{{ number_format($layanan->harga) }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- JUMLAH -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">
            Jumlah / Kg
        </label>

        <input type="number" name="qty" min="1"
               class="w-full px-4 py-2 rounded-lg border
                      focus:ring-2 focus:ring-purple-500"
               required>
    </div>

    <!-- SUBMIT -->
    <button
        class="px-6 py-3 bg-purple-600 text-white rounded-xl
               hover:bg-purple-700 transition">
        Simpan Transaksi
    </button>

</form>

@endsection