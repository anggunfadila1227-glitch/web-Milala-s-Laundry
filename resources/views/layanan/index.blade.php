@extends('layouts.dashboard')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-purple-700">
        🧺 Data Layanan Laundry
    </h1>

    <a href="{{ route('layanan.create') }}"
       class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl font-semibold">
        + Tambah Layanan
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-purple-100">
            <tr>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Harga</th>
                <th class="p-3 text-left">Satuan</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($layanans as $layanan)
                <tr class="border-t">
                    <td class="p-3 font-semibold">
                        {{ $layanan->nama }}
                    </td>

                    <td class="p-3">
                        Rp {{ number_format($layanan->harga) }}
                    </td>

                    <td class="p-3">
                        {{ $layanan->satuan ?? 'kg' }}
                    </td>

                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('layanan.edit', $layanan->id) }}"
                           class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg">
                            Edit
                        </a>

                        <form action="{{ route('layanan.destroy', $layanan->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Hapus layanan ini?')">
                            @csrf
                            @method('DELETE')

                            <button
                                class="px-3 py-1 bg-red-100 text-red-600 rounded-lg">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        Belum ada layanan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection