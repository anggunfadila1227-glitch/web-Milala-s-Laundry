@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-xl font-bold mb-4">
        Detail Transaksi
    </h1>

    <p>
        <strong>Kode:</strong>
        {{ $transaksi->kode_transaksi ?? '-' }}
    </p>

    <p>
        <strong>Pelanggan:</strong>
        {{ $transaksi->user->name ?? '-' }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ strtoupper($transaksi->status ?? '-') }}
    </p>

    <hr class="my-4">

    <table class="w-full text-sm border border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1 text-left">Layanan</th>
                <th class="border px-2 py-1 text-center">Qty</th>
                <th class="border px-2 py-1 text-right">Harga</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($transaksi->details->filter(fn ($item) => $item->layanan) as $item)
                <tr>
                    <td class="border px-2 py-1">
                        {{ $item->layanan->nama_layanan }}
                    </td>
                    <td class="border px-2 py-1 text-center">
                        {{ $item->qty }}
                    </td>
                    <td class="border px-2 py-1 text-right">
                        Rp {{ number_format($item->harga) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border px-2 py-4 text-center text-gray-400">
                        Detail transaksi belum tersedia
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>
@endsection
