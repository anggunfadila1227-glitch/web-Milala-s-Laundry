@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-purple-700 mb-6">
        🧺 Daftar Pesanan
    </h1>

    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-purple-100 rounded-2xl overflow-hidden shadow-sm">
            <thead class="bg-purple-100 text-purple-700">
                <tr>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Total</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pesanans as $pesanan)
                    <tr class="border-t hover:bg-purple-50 transition">
                        <td class="p-3">
                            {{ $pesanan->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3">
                            @if ($pesanan->status === 'proses')
                                <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                                    Proses
                                </span>
                            @elseif ($pesanan->status === 'selesai')
                                <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                    Selesai
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            @endif
                        </td>

                        <td class="p-3 font-semibold">
                            Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-400">
                            😿 Belum ada pesanan laundry
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection