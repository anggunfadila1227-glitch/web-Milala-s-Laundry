@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <p class="mb-4 text-gray-700">Halo, <span class="font-semibold">{{ auth()->user()->name }}</span>! Selamat datang di Web Laundry.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Info Pesanan User -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Transaksi Anda</h2>
            <p>Total Transaksi: <span class="font-bold">{{ auth()->user()->transaksis()->count() }}</span></p>
            <a href="{{ route('transaksi.index') }}" class="mt-3 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Lihat Transaksi
            </a>
        </div>

        <!-- Buat Transaksi Baru -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Buat Transaksi Baru</h2>
            <p>Klik tombol di bawah untuk membuat Transaksi laundry baru.</p>
            <a href="{{ route('transaksi.create') }}" class="mt-3 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Buat Transaksi
            </a>
        </div>
    </div>

    <!-- Ringkasan Transaksi Terbaru -->
    <div class="mt-10">
        <h2 class="text-2xl font-semibold mb-4">Transaksi Terbaru</h2>
        @if(auth()->user()->teransaksi->count() > 0)
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="text-left py-2 px-4">No</th>
                        <th class="text-left py-2 px-4">Layanan</th>
                        <th class="text-left py-2 px-4">Status</th>
                        <th class="text-left py-2 px-4">Total</th>
                        <th class="text-left py-2 px-4">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(auth()->user()->transaksi()->latest()->take(5)->get() as $index => $transaksi)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $transaksi->layanan->nama ?? '-' }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 rounded {{ $transaksi->status == 'selesai' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4">Rp {{ number_format($transaksi->total,0,",",".") }}</td>
                        <td class="py-2 px-4">{{ $transaksi->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Belum ada transaksi dibuat.</p>
        @endif
    </div>
</div>
@endsection