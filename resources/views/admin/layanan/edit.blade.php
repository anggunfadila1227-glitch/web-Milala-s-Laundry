@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .form-wrapper {
        max-width: 1000px;
        margin: auto;
    }

    .card-form {
        background: #fdfcff;
        border-radius: 26px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(0,0,0,.08);
    }

    .form-label {
        font-weight: 600;
        color: #4b5563;
    }

    .btn-purple {
        background: #7c6ae3;
        color: white;
        border-radius: 12px;
        padding: 10px 22px;
        font-weight: 600;
    }

    .btn-purple:hover {
        background: #6a5ad1;
        color: white;
    }

    .btn-soft {
        border-radius: 12px;
        padding: 10px 22px;
        font-weight: 600;
    }
</style>

<div class="container py-5">
    <div class="form-wrapper">

        <h4 class="fw-bold mb-4 text-white">
            ✏️ Edit Layanan Laundry
        </h4>

        <div class="card-form">

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

<<<<<<< HEAD
            <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- NAMA LAYANAN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nama Layanan
                    </label>
                    <input type="text"
                           name="nama_layanan"
                           value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                           class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                           required>
                </div>

                {{-- JENIS LAYANAN (WAJIB ADA) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Jenis Layanan
                    </label>

                    @php
                        $selectedLayanan = old('jenis_layanan', $layanan->jenis_layanan);
                    @endphp

                    <select name="jenis_layanan"
                            class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            required>
                        <option value="">-- Pilih Jenis Layanan --</option>
                        <option value="baju" {{ $selectedLayanan == 'baju' ? 'selected' : '' }}>Baju</option>
                        <option value="seragam" {{ $selectedLayanan == 'seragam' ? 'selected' : '' }}>Seragam</option>
                        <option value="bedcover" {{ $selectedLayanan == 'bedcover' ? 'selected' : '' }}>Bedcover</option>
                        <option value="karpet" {{ $selectedLayanan == 'karpet' ? 'selected' : '' }}>Karpet</option>
                        <option value="sepatu" {{ $selectedLayanan == 'sepatu' ? 'selected' : '' }}>Sepatu</option>
                        <option value="selimut" {{ $selectedLayanan == 'selimut' ? 'selected' : '' }}>Selimut</option>
                    </select>
                </div>

                {{-- HARGA --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Harga (Rp)
                    </label>
                    <input type="number"
                           name="harga"
                           value="{{ old('harga', $layanan->harga) }}"
                           class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                           required>
                </div>

                {{-- JENIS CUCIAN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Jenis Cucian
                    </label>

                    @php
                        $selectedJenis = old('jenis_cucian', $layanan->jenis_cucian);
                    @endphp

                    <select name="jenis_cucian"
                            class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            required>
                        <option value="">-- Pilih Jenis Cucian --</option>
                        <option value="reguler" {{ $selectedJenis == 'reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="kering" {{ $selectedJenis == 'kering' ? 'selected' : '' }}>Kering</option>
                        <option value="setrika" {{ $selectedJenis == 'setrika' ? 'selected' : '' }}>Setrika</option>
                        <option value="cuci_setrika" {{ $selectedJenis == 'cuci_setrika' ? 'selected' : '' }}>Cuci + Setrika</option>
                        <option value="express" {{ $selectedJenis == 'express' ? 'selected' : '' }}>Express</option>
                    </select>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Status
                    </label>
                    <select name="status"
                            class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            required>
                        <option value="aktif" {{ old('status', $layanan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $layanan->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi"
                              rows="4"
                              class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('admin.layanan.index') }}"
                       class="text-gray-600 hover:text-gray-800 font-medium">
                        ← Kembali
                    </a>

                    <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                        Update Layanan
                    </button>
                </div>
            </form>
=======
           <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" class="space-y-5">
    @csrf
    @method('PUT')

    {{-- NAMA LAYANAN --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Nama Layanan
        </label>
        <input type="text"
               name="nama_layanan"
               value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
               class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
               required>
    </div>

    {{-- HARGA --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Harga (Rp)
        </label>
        <input type="number"
               name="harga"
               value="{{ old('harga', $layanan->harga) }}"
               class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
               required>
    </div>

    {{-- JENIS CUCIAN --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Jenis Cucian
        </label>

        @php
            $selectedJenis = old('jenis_cucian', $layanan->jenis_cucian);
        @endphp

        <select name="jenis_cucian"
                class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                required>
            <option value="">-- Pilih Jenis Cucian --</option>
            <option value="reguler" {{ $selectedJenis == 'reguler' ? 'selected' : '' }}>Reguler</option>
            <option value="kering" {{ $selectedJenis == 'kering' ? 'selected' : '' }}>Kering</option>
            <option value="setrika" {{ $selectedJenis == 'setrika' ? 'selected' : '' }}>Setrika</option>
            <option value="cuci_setrika" {{ $selectedJenis == 'cuci_setrika' ? 'selected' : '' }}>Cuci + Setrika</option>
            <option value="express" {{ $selectedJenis == 'express' ? 'selected' : '' }}>Express</option>
        </select>
    </div>

    {{-- STATUS --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Status
        </label>
        <select name="status"
                class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                required>
            <option value="aktif" {{ old('status', $layanan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ old('status', $layanan->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    {{-- DESKRIPSI --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Deskripsi
        </label>
        <textarea name="deskripsi"
                  rows="4"
                  class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
    </div>

    {{-- BUTTON --}}
    <div class="flex justify-between items-center pt-4">
        <a href="{{ route('admin.layanan.index') }}"
           class="text-gray-600 hover:text-gray-800 font-medium">
            ← Kembali
        </a>

        <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition">
            Update Layanan
        </button>
    </div>
</form>
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

        </div>
    </div>
</div>
@endsection
