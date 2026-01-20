@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    💳 Pembayaran Pesanan
</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead>
            <tr class="bg-purple-600 text-white">
                <th class="p-3 text-left">Kode Transaksi</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-right">Total</th>
                <th class="p-3 text-center">Status</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksis as $t)
                <tr class="border-b hover:bg-purple-50 transition">
                    <td class="p-3 font-semibold">
                        {{ $t->kode_transaksi }}
                    </td>

                    <td class="p-3">
                        {{ $t->user->name }}
                    </td>

                    <td class="p-3 text-right">
                        Rp {{ number_format($t->total) }}
                    </td>

                    <td class="p-3 text-center">
                        @if ($t->status == 'proses')
                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                Proses
                            </span>
                        @elseif ($t->status == 'selesai')
                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                Selesai
                            </span>
                        @elseif ($t->status == 'dibayar')
                            <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                Dibayar
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-600">
                                {{ ucfirst($t->status) }}
                            </span>
                        @endif
                    </td>

                    <td class="p-3 text-center space-x-2">

                        {{-- TOMBOL BAYAR --}}
                        @if ($t->status != 'dibayar')
                            <form action="{{ route('admin.pesanan.bayar', $t->id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                <button
                                    class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 text-xs">
                                    ✔ Bayar
                                </button>
                            </form>
                        @else
                            <span class="text-green-600 font-semibold text-xs">
                                ✔ Sudah Dibayar
                            </span>
                        @endif

                        {{-- STRUK --}}
                        <a href="{{ route('admin.struk', $t->id) }}"
                           class="px-3 py-1 bg-purple-600 text-white rounded-lg text-xs hover:bg-purple-700">
                            🧾 Struk
                        </a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Belum ada transaksi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection