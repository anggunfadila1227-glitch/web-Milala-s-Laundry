@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Layanan</h1>
            <p class="text-sm text-gray-500 mt-1">
                Dashboard / Layanan / Tambah
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-xl shadow p-6">

            <form action="{{ route('admin.layanan.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- NAMA LAYANAN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nama Layanan
                    </label>
                    <input type="text"
                        name="nama_layanan"
                        value="{{ old('nama_layanan') }}"
                        placeholder="Contoh: Cuci Sepatu"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                {{-- JENIS LAYANAN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Jenis Layanan
                    </label>
                    <select name="jenis_layanan"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                        required>
                        <option value="">-- Pilih Jenis Layanan --</option>
                        <option value="baju" {{ old('jenis_layanan') == 'baju' ? 'selected' : '' }}>Baju</option>
                        <option value="seragam" {{ old('jenis_layanan') == 'seragam' ? 'selected' : '' }}>Seragam</option>
                        <option value="bedcover" {{ old('jenis_layanan') == 'bedcover' ? 'selected' : '' }}>Bedcover</option>
                        <option value="karpet" {{ old('jenis_layanan') == 'karpet' ? 'selected' : '' }}>Karpet</option>
                        <option value="sepatu" {{ old('jenis_layanan') == 'sepatu' ? 'selected' : '' }}>Sepatu</option>
                        <option value="selimut" {{ old('jenis_layanan') == 'selimut' ? 'selected' : '' }}>Selimut</option>
                    </select>
                </div>

                {{-- ✅ JENIS CUCIAN (INI YANG HILANG) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Jenis Cucian
                    </label>
                    <select name="jenis_cucian"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                        required>
                        <option value="">-- Pilih Jenis Cucian --</option>
                        <option value="reguler" {{ old('jenis_cucian') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="kering" {{ old('jenis_cucian') == 'kering' ? 'selected' : '' }}>Kering</option>
                        <option value="setrika" {{ old('jenis_cucian') == 'setrika' ? 'selected' : '' }}>Setrika</option>
                        <option value="cuci_setrika" {{ old('jenis_cucian') == 'cuci_setrika' ? 'selected' : '' }}>Cuci + Setrika</option>
                        <option value="express" {{ old('jenis_cucian') == 'express' ? 'selected' : '' }}>Express</option>
                    </select>
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi"
                        rows="4"
                        placeholder="Deskripsi layanan..."
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- HARGA --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Harga (Rp)
                    </label>
                    <input type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        placeholder="Contoh: 15000"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Status
                    </label>
                    <select name="status"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('admin.layanan.index') }}"
                        class="text-gray-600 hover:text-gray-800 font-medium">
                        ← Kembali
                    </a>

                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                        💾 Simpan Layanan
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
