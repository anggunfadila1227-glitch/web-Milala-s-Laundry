@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Data Transaksi</h1>

    @if($transaksis->count())
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">User</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Tanggal</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $item)
                <tr>
                    <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-3 py-2">
                        {{ $item->user->name ?? '-' }}
                    </td>
                    <td class="border px-3 py-2">
                        {{ $item->status ?? '-' }}
                    </td>
                    <td class="border px-3 py-2">
                        {{ $item->created_at->format('d-m-Y') }}
                    </td>
                    <td class="border px-3 py-2">
                        <a href="{{ route('admin.transaksi.show', $item->id) }}"
                           class="text-blue-600">
                           Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Belum ada transaksi</p>
    @endif
</div>
@endsection
