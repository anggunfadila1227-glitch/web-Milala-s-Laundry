@extends('layouts.admin')

@section('title', 'Struk Pembayaran')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4 text-center">
            🧾 STRUK PEMBAYARAN
        </h1>

        <div class="space-y-2 text-sm">
            <p><strong>No Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>Pelanggan:</strong> {{ $transaksi->user->name ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Status:</strong> {{ strtoupper($transaksi->status) }}</p>
        </div>

        <hr class="my-4">

        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">Layanan</th>
                    <th class="border px-2 py-1">Harga</th>
                    <th class="border px-2 py-1">Qty</th>
                    <th class="border px-2 py-1">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->details as $item)
                    <tr>
                        <td class="border px-2 py-1">
                            {{ $item->layanan->nama_layanan ?? '-' }}
                        </td>
                        <td class="border px-2 py-1">
                            Rp {{ number_format($item->harga) }}
                        </td>
                        <td class="border px-2 py-1 text-center">
                            {{ $item->qty }}
                        </td>
                        <td class="border px-2 py-1">
                            Rp {{ number_format($item->subtotal) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="mt-4 text-right font-bold">
            Total: Rp {{ number_format($transaksi->total_harga) }}
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('admin.pembayaran.index') }}" class="text-gray-600">
                ← Kembali
            </a>

            <button onclick="window.print()" class="bg-purple-600 text-white px-4 py-2 rounded">
                🖨 Cetak
            </button>
        </div>

    </div>
@endsection
