@extends('layouts.dashboard')

@section('content')

<h1 class="text-3xl font-bold text-purple-700 mb-8">
    Selamat datang, {{ auth()->user()->name }}! 👕
</h1>

{{-- Ringkasan transaksi --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    {{-- Menunggu Konfirmasi --}}
    <div class="bg-yellow-100 rounded-3xl shadow p-6 flex justify-between items-center hover:shadow-lg transition">
        <div>
            <h2 class="text-lg font-semibold text-yellow-700">Menunggu Konfirmasi</h2>
            <p class="text-4xl font-bold text-yellow-800">
                {{ $transaksis->where('status','menunggu')->count() }}
            </p>
        </div>
        <span class="text-yellow-500 text-5xl">⏳</span>
    </div>

    {{-- Sedang Diproses --}}
    <div class="bg-yellow-50 rounded-3xl shadow p-6 flex justify-between items-center hover:shadow-lg transition">
        <div>
            <h2 class="text-lg font-semibold text-yellow-700">Sedang Diproses</h2>
            <p class="text-4xl font-bold text-yellow-800">
                {{ $transaksis->where('status','proses')->count() }}
            </p>
        </div>
        <span class="text-yellow-500 text-5xl">🔄</span>
    </div>

    {{-- Selesai --}}
    <div class="bg-green-50 rounded-3xl shadow p-6 flex justify-between items-center hover:shadow-lg transition">
        <div>
            <h2 class="text-lg font-semibold text-green-700">Selesai</h2>
            <p class="text-4xl font-bold text-green-800">
                {{ $transaksis->where('status','selesai')->count() }}
            </p>
        </div>
        <span class="text-green-500 text-5xl">✅</span>
    </div>

    {{-- Dibatalkan --}}
    <div class="bg-red-50 rounded-3xl shadow p-6 flex justify-between items-center hover:shadow-lg transition">
        <div>
            <h2 class="text-lg font-semibold text-red-700">Dibatalkan</h2>
            <p class="text-4xl font-bold text-red-800">
                {{ $transaksis->where('status','batal')->count() }}
            </p>
        </div>
        <span class="text-red-500 text-5xl">❌</span>
    </div>
</div>

{{-- Tombol buat transaksi baru --}}
<div class="mb-8 text-right">
    <a href="{{ route('transaksi.create') }}"
       class="inline-block px-6 py-3 bg-purple-600 text-white rounded-2xl hover:bg-purple-700 shadow transition">
        ➕ Buat Transaksi Baru
    </a>
</div>

    @foreach($transaksis as $transaksi)
        <div class="bg-white rounded-3xl shadow p-6 mb-6 hover:shadow-lg transition">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-lg text-purple-700">
                    Kode: {{ $transaksi->kode_transaksi }}
                </h2>
                <span class="text-gray-500 text-sm">
                    {{ $transaksi->created_at->format('d M Y H:i') }}
                </span>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                @if($transaksi->status == 'selesai')
                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                        Selesai
                    </span>
                @elseif($transaksi->status == 'proses')
                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm">
                        Sedang Diproses
                    </span>
                @elseif($transaksi->status == 'menunggu')
                    <span class="px-3 py-1 rounded-full bg-yellow-200 text-yellow-800 font-semibold text-sm">
                        Menunggu Konfirmasi
                    </span>
                @elseif($transaksi->status == 'batal')
                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm">
                        Dibatalkan
                    </span>
                @endif
            </div>

            {{-- Detail transaksi --}}
            <table class="w-full text-sm table-auto border-collapse mb-4">
                <thead>
                    <tr class="bg-purple-600 text-white">
                        <th class="p-2 text-left">Layanan</th>
                        <th class="p-2 text-left">Jenis Cucian</th>
                        <th class="p-2 text-right">Qty (kg)</th>
                        <th class="p-2 text-right">Harga</th>
                        <th class="p-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->details as $detail)
                    <tr class="border-b">
                        <td class="p-2">{{ $detail->layanan->nama_layanan }}</td>
                        <td class="p-2">{{ $detail->jenis_cucian }}</td>
                        <td class="p-2 text-right">{{ $detail->qty }}</td>
                        <td class="p-2 text-right">Rp {{ number_format($detail->harga) }}</td>
                        <td class="p-2 text-right">Rp {{ number_format($detail->subtotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Total --}}
            <div class="mt-4 text-right font-bold text-lg">
                Total: Rp {{ number_format($transaksi->total) }}
            </div>
        </div>
    @endforeach

@endsection