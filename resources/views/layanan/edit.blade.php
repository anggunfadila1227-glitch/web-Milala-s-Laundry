@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    ✏️ Edit Layanan
</h1>

<form action="{{ route('layanan.update', $layanan->id) }}"
      method="POST"
      class="bg-white rounded-2xl shadow p-6 max-w-xl">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-semibold mb-1">
            Nama Layanan
        </label>
        <input type="text"
               name="nama"
               value="{{ $layanan->nama }}"
               class="w-full border rounded-xl px-4 py-2"
               required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">
            Harga
        </label>
        <input type="number"
               name="harga"
               value="{{ $layanan->harga }}"
               class="w-full border rounded-xl px-4 py-2"
               required>
    </div>

    <div class="mb-6">
        <label class="block font-semibold mb-1">
            Satuan
        </label>
        <input type="text"
               name="satuan"
               value="{{ $layanan->satuan }}"
               class="w-full border rounded-xl px-4 py-2">
    </div>

    <div class="flex gap-3">
        <button
            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-xl font-semibold">
            Update
        </button>

        <a href="{{ route('layanan.index') }}"
           class="px-6 py-2 border rounded-xl">
            Kembali
        </a>
    </div>

</form>

@endsection