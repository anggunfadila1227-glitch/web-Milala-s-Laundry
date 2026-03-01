@extends('layouts.dashboard')

@section('content')

<h1 class="text-3xl font-bold text-purple-700 mb-8">
    Selamat datang, {{ auth()->user()->name ?? 'User' }}! 👕
</h1>

{{-- STATUS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    {{-- Menunggu --}}
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-center border-l-4 border-yellow-500">
        <div class="p-3 bg-yellow-100 rounded-full mr-4">
            <i class="fas fa-hourglass-half text-yellow-600 text-2xl"></i>
        </div>
        <div>
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Menunggu Konfirmasi</h2>
            <p class="text-4xl font-bold text-yellow-600 mt-1">{{ $countMenunggu }}</p>
        </div>
    </div>

    {{-- Proses --}}
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-center border-l-4 border-blue-500">
        <div class="p-3 bg-blue-100 rounded-full mr-4">
            <i class="fas fa-sync-alt text-blue-600 text-2xl"></i>
        </div>
        <div>
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Sedang Diproses</h2>
            <p class="text-4xl font-bold text-blue-600 mt-1">{{ $countProses }}</p>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-center border-l-4 border-green-500">
        <div class="p-3 bg-green-100 rounded-full mr-4">
            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
        </div>
        <div>
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Selesai</h2>
            <p class="text-4xl font-bold text-green-600 mt-1">{{ $countSelesai }}</p>
        </div>
    </div>

    {{-- Batal --}}
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-center border-l-4 border-red-500">
        <div class="p-3 bg-red-100 rounded-full mr-4">
            <i class="fas fa-times-circle text-red-600 text-2xl"></i>
        </div>
        <div>
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Dibatalkan</h2>
            <p class="text-4xl font-bold text-red-600 mt-1">{{ $countBatal }}</p>
        </div>
    </div>
</div>

{{-- Form Pencarian & Buat Transaksi --}}
<div class="mb-8 flex justify-between items-center">
    <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-4">
        <input type="text" name="search" placeholder="Cari kode atau status..." 
            value="{{ request('search') }}"
            class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 w-64">
        <button type="submit" class="p-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
            <i class="fas fa-search"></i> Cari
        </button>
        @if(request('search'))
            <a href="{{ route('dashboard') }}" class="p-2 text-gray-500 hover:text-gray-700" title="Reset">
                <i class="fas fa-times"></i> Reset
            </a>
        @endif
    </form>

    <a href="{{ route('transaksi.create') }}"
        class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 shadow-md transition duration-150">
        <i class="fas fa-plus"></i> Buat Transaksi Baru
    </a>
</div>

{{-- Loop Transaksi --}}
@foreach($transaksis as $transaksi)
<div class="bg-white rounded-xl shadow-md p-6 mb-6 hover:shadow-lg transition duration-150">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg text-purple-700">Kode: {{ $transaksi->kode_transaksi }}</h2>
        <span class="text-gray-500 text-sm">{{ $transaksi->created_at->format('d M Y H:i') }}</span>
    </div>

    {{-- Status --}}
    <div class="mb-4">
        @if($transaksi->status == 'selesai')
            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm flex items-center">
                <i class="fas fa-check-circle mr-2"></i> Selesai
            </span>
        @elseif($transaksi->status == 'proses')
            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> Sedang Diproses
            </span>
        @elseif($transaksi->status == 'menunggu')
            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm flex items-center">
                <i class="fas fa-hourglass-half mr-2"></i> Menunggu Konfirmasi
            </span>
        @elseif($transaksi->status == 'batal')
            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Dibatalkan
            </span>
        @endif
    </div>

    {{-- Detail transaksi --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm table-auto border-collapse mb-4">
            <thead>
                <tr class="bg-purple-600 text-white">
                    <th class="p-3 text-left rounded-tl-lg">Layanan</th>
                    <th class="p-3 text-left">Jenis Cucian</th>
                    <th class="p-3 text-right">Qty (kg)</th>
                    <th class="p-3 text-right">Harga</th>
                    <th class="p-3 text-right rounded-tr-lg">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi->details as $detail)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $detail->layanan->nama_layanan ?? '-' }}</td>
                    <td class="p-3">{{ $detail->jenisCucian->jenis ?? '-' }}</td>
                    <td class="p-3 text-right">{{ $detail->qty ?? 0 }}</td>
                    <td class="p-3 text-right">Rp {{ number_format($detail->harga ?? 0) }}</td>
                    <td class="p-3 text-right">Rp {{ number_format($detail->subtotal ?? 0) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-3">Belum ada detail transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Total --}}
    <div class="mt-4 text-right font-bold text-xl text-gray-800">
        Total: Rp {{ number_format($transaksi->total ?? 0) }}
    </div>
</div>
@endforeach

{{-- Pagination --}}
<div class="mt-8">
    {{ $transaksis->links() }}
</div>

@endsection
