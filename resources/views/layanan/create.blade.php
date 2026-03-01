@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    ➕ Buat Transaksi Laundry
</h1>

<form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
    @csrf

    <!-- PILIH LAYANAN -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">
            Pilih Layanan
        </label>

        <select name="layanan_id" id="layanan_id"
            class="w-full px-4 py-2 rounded-lg border bg-black text-info-800
                   focus:outline-none focus:ring-2 focus:ring-purple-500">
            <option value="">-- Pilih Layanan --</option>
            @foreach ($layanans as $layanan)
                <option value="{{ $layanan->id }}"
                    data-harga="{{ $layanan->harga }}">
                    {{ $layanan->nama_layanan }} ({{ $layanan->jenis_cucian }})
                </option>
            @endforeach
        </select>

        <p id="harga_layanan" class="mt-2 font-semibold text-gray-700">
            Harga: -
        </p>
    </div>

    <!-- JUMLAH -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">
            Jumlah / Kg
        </label>

        <input type="number" name="qty" id="qty" min="1"
               class="w-full px-4 py-2 rounded-lg border
                      focus:ring-2 focus:ring-purple-500"
               required>
    </div>

    <!-- TOTAL HARGA -->
    <div>
        <p id="total_harga" class="font-semibold text-gray-700">
            Total Harga: Rp - 
        </p>
    </div>

    <!-- SUBMIT -->
    <button
        class="px-6 py-3 bg-purple-600 text-white rounded-xl
               hover:bg-purple-700 transition">
        Simpan Transaksi
    </button>
</form>

<!-- JS untuk otomatis update harga -->
<script>
    const layananSelect = document.getElementById('layanan_id');
    const hargaElement = document.getElementById('harga_layanan');
    const qtyInput = document.getElementById('qty');
    const totalElement = document.getElementById('total_harga');

    function updateHarga() {
        const selectedOption = layananSelect.options[layananSelect.selectedIndex];
        const harga = selectedOption.dataset.harga || 0;
        const qty = qtyInput.value || 1;

        hargaElement.textContent = 'Harga: Rp ' + new Intl.NumberFormat().format(harga);
        totalElement.textContent = 'Total Harga: Rp ' + new Intl.NumberFormat().format(harga * qty);
    }

    layananSelect.addEventListener('change', updateHarga);
    qtyInput.addEventListener('input', updateHarga);
</script>

@endsection
