@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-xl font-bold mb-4">
        Detail Transaksi
    </h1>

    <p><strong>Kode:</strong> {{ $transaksi->kode_transaksi }}</p>
    <p><strong>Pelanggan:</strong> {{ $transaksi->user->name ?? '-' }}</p>
    <p><strong>Status:</strong> {{ strtoupper($transaksi->status) }}</p>

    <hr class="my-4">

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">Layanan</th>
                <th class="border px-2 py-1">Qty</th>
                <th class="border px-2 py-1">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->details as $item)
            <tr>
                <td class="border px-2 py-1">
                    {{ $item->layanan->nama_layanan }}
                </td>
                <td class="border px-2 py-1 text-center">
                    {{ $item->qty }}
                </td>
                <td class="border px-2 py-1">
                    Rp {{ number_format($item->harga) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
