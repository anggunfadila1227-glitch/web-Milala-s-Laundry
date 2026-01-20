@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    📦 Kelola Pesanan Customer
</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-purple-100 text-purple-700">
            <tr>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Layanan</th>
                <th class="p-3 text-left">Berat</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse ($pesanans as $p)
            <tr class="border-t hover:bg-purple-50 transition">

                <td class="p-3">
                    {{ $p->user->name ?? '-' }}
                </td>

                <td class="p-3">
                    {{ $p->layanan->nama ?? '-' }}
                </td>

                <td class="p-3">
                    {{ $p->berat }} kg
                </td>

                <td class="p-3 font-semibold">
                    Rp {{ number_format($p->total) }}
                </td>

                <td class="p-3">
                    @if ($p->status == 'proses')
                        <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                            Proses
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                            Selesai
                        </span>
                    @endif
                </td>

                <td class="p-3">
                    <form action="{{ route('admin.pesanan.status', $p->id) }}" method="POST">
                        @csrf

                        <select name="status"
                                onchange="this.form.submit()"
                                class="border rounded-lg px-3 py-1 text-sm">

                            <option value="proses" {{ $p->status=='proses'?'selected':'' }}>
                                Proses
                            </option>

                            <option value="selesai" {{ $p->status=='selesai'?'selected':'' }}>
                                Selesai
                            </option>
                        </select>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-400">
                    Belum ada pesanan
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>

</div>

@endsection