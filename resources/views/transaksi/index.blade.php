@extends('layouts.dashboard')

@section('content')

    <h1 class="text-2xl font-bold text-purple-700 mb-6">
        📦 Transaksi Saya
    </h1>

    {{-- Flash message sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Jika tidak ada transaksi --}}
    @if ($transaksis->count() == 0)
        <div class="bg-white p-8 rounded-2xl text-center shadow">
            <p class="text-gray-500 mb-4">
                Kamu belum memiliki transaksi laundry 😥
            </p>

            <a href="{{ route('transaksi.create') }}"
                class="inline-block px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                ➕ Buat Transaksi Baru
            </a>
        </div>
    @else

        {{-- Tampilkan transaksi --}}
        @foreach ($transaksis as $transaksi)
            <div class="bg-white rounded-2xl shadow p-6 mb-6">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-lg text-purple-700">
                        Kode: {{ $transaksi->kode_transaksi }}
                    </h2>
                    <span class="text-gray-500 text-sm">
                        {{ $transaksi->created_at->format('d M Y H:i') }}
                    </span>
                </div>

                {{-- STATUS TRANSAKSI (SUDAH FIX) --}}
                <div class="mb-4">
                    @if (strtolower($transaksi->status_pembayaran) === 'lunas')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                            LUNAS
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm">
                            Sedang Diproses
                        </span>
                    @endif
                </div>

                {{-- Tabel Detail --}}
                <table class="w-full text-sm table-auto border-collapse">
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
                        @forelse ($transaksi->details as $detail)
                            <tr class="border-b">
                                <td class="p-2">
                                    {{ $detail->layanan->nama_layanan ?? '-' }}
                                </td>

                                <td class="p-2">
                                    {{ $detail->jenisCucian->nama_jenis ?? '-' }}
                                </td>

                                <td class="p-2 text-right">
                                    {{ $detail->qty }}
                                </td>

                                <td class="p-2 text-right">
                                    Rp {{ number_format($detail->harga) }}
                                </td>

                                <td class="p-2 text-right">
                                    Rp {{ number_format($detail->subtotal) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-400 py-4">
                                    Detail transaksi belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="mt-4 text-right font-bold text-lg">
                    Total: Rp {{ number_format($transaksi->total) }}
                </div>

            </div>
        @endforeach
    @endif

@endsection
