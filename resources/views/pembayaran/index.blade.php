@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold text-purple-700 mb-6">
    💳 Pembayaran Saya
</h1>

@if($transaksis->count() == 0)
    <p class="text-gray-500">Belum ada transaksi untuk dibayar.</p>
@else
    <table class="w-full text-sm table-auto border-collapse">
        <thead>
            <tr class="bg-purple-600 text-white">
                <th class="p-2 text-left">Kode Transaksi</th>
                <th class="p-2 text-left">Tanggal</th>
                <th class="p-2 text-right">Total</th>
                <th class="p-2 text-right">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr class="border-b">
                <td class="p-2">{{ $transaksi->kode_transaksi }}</td>
                <td class="p-2">{{ $transaksi->created_at->format('d-m-Y') }}</td>
                <td class="p-2 text-right">Rp {{ number_format($transaksi->total) }}</td>
                <td class="p-2 text-right">{{ ucfirst($transaksi->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection