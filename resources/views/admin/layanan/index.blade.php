@extends('layouts.admin')

@section('content')

{{-- JUDUL --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-purple-700">
        👕 Data Layanan Laundry
    </h1>

    <a href="{{ route('admin.layanan.create') }}"
       class="bg-purple-600 hover:bg-purple-700
              text-white px-5 py-2 rounded-lg font-semibold transition">
        ➕ Tambah Layanan
    </a>
</div>

{{-- FLASH MESSAGE --}}
@if (session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

{{-- TABEL --}}
<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="p-3 text-left">No</th>
                <th class="p-3 text-left">Nama Layanan</th>
                <th class="p-3 text-left">Jenis Cucian</th>
                <th class="p-3 text-left">Harga / Kg</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($layanans as $layanan)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-3 font-semibold">
                        {{ $layanan->nama_layanan }}
                    </td>

                    <td class="p-3">
                        {{ $layanan->jenis_cucian }}
                    </td>

                    <td class="p-3">
                        Rp {{ number_format($layanan->harga) }}
                    </td>

                    <td class="p-3 text-center space-x-2">

                        <a href="{{ route('admin.layanan.edit', $layanan->id) }}"
                           class="inline-block bg-yellow-400 hover:bg-yellow-500
                                  text-white px-3 py-1 rounded-lg text-xs">
                            ✏️ Edit
                        </a>

                        <form action="{{ route('admin.layanan.destroy', $layanan->id) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Yakin hapus layanan ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-500 hover:bg-red-600
                                       text-white px-3 py-1 rounded-lg text-xs">
                                🗑️ Hapus
                            </button>

                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"
                        class="p-6 text-center text-gray-500">
                        Belum ada data layanan
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection