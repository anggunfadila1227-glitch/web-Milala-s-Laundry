@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold text-purple-700 mb-6">
    📦 Buat Transaksi Laundry
</h1>

<form action="{{ route('transaksi.store') }}" method="POST"
      class="bg-white rounded-2xl shadow p-6 max-w-3xl space-y-6">

    @csrf

    <table class="w-full text-sm" id="table-transaksi">
        <thead>
            <tr class="bg-purple-600 text-white">
                <th class="p-3">Layanan & Jenis Cucian</th>
                <th class="p-3">Qty (kg)</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Subtotal</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="p-2">
                    <select name="items[0][layanan_id]"
                        class="w-full border rounded-xl p-2 layanan" required>
                        <option value="">-- pilih layanan --</option>
                        @foreach ($layanans as $l)
                            <option value="{{ $l->id }}"
                                data-harga="{{ $l->harga }}"
                                data-jenis="{{ $l->jenis_cucian }}">
                                {{ $l->nama_layanan }} — {{ $l->jenis_cucian }} — Rp {{ number_format($l->harga) }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td class="p-2">
                    <input type="number" name="items[0][qty]"
                        step="0.1" value="1"
                        class="w-full border rounded-xl p-2 qty" required>
                </td>

                <td class="p-2">
                    <input type="number" name="items[0][harga]"
                        class="w-full border rounded-xl p-2 harga" readonly>
                </td>

                <td class="p-2">
                    <input type="number" class="w-full border rounded-xl p-2 subtotal" readonly>
                </td>

                <td class="p-2 text-center">
                    <button type="button" class="hapus text-red-600">❌</button>
                </td>
            </tr>
        </tbody>
    </table>

    <button type="button" id="addRow"
        class="mt-4 px-4 py-2 bg-green-600 text-white rounded-xl">
        ➕ Tambah Layanan
    </button>

    <div class="mt-6 text-right text-lg font-bold">
        Total: Rp <span id="total">0</span>
    </div>

    <div class="mt-6 text-right">
        <button type="submit"
            class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700">
            💾 Simpan Transaksi
        </button>
    </div>

</form>

<script>
let row = 1;

function hitung() {
    let total = 0;
    document.querySelectorAll('#table-transaksi tbody tr').forEach(tr => {
        let qty = parseFloat(tr.querySelector('.qty').value) || 0;
        let harga = parseFloat(tr.querySelector('.harga').value) || 0;
        let subtotal = qty * harga;
        tr.querySelector('.subtotal').value = subtotal;
        total += subtotal;
    });
    document.getElementById('total').innerText = total.toLocaleString();
}

// tambah baris
document.getElementById('addRow').addEventListener('click', function () {
    let tbody = document.querySelector('#table-transaksi tbody');
    let tr = document.createElement('tr');
    tr.innerHTML = `
        <td class="p-2">
            <select name="items[${row}][layanan_id]"
                class="w-full border rounded-xl p-2 layanan" required>
                <option value="">-- pilih layanan --</option>
                @foreach ($layanans as $l)
                    <option value="{{ $l->id }}"
                        data-harga="{{ $l->harga }}"
                        data-jenis="{{ $l->jenis_cucian }}">
                        {{ $l->nama_layanan }} — {{ $l->jenis_cucian }} — Rp {{ $l->harga }}
                    </option>
                @endforeach
            </select>
        </td>
        <td class="p-2">
            <input type="number" name="items[${row}][qty]"
                step="0.1" value="1"
                class="w-full border rounded-xl p-2 qty" required>
        </td>
        <td class="p-2">
            <input type="number" name="items[${row}][harga]"
                class="w-full border rounded-xl p-2 harga" readonly>
        </td>
        <td class="p-2">
            <input type="number"
                class="w-full border rounded-xl p-2 subtotal" readonly>
        </td>
        <td class="p-2 text-center">
            <button type="button" class="hapus text-red-600">❌</button>
        </td>
    `;
    tbody.appendChild(tr);
    row++;
});

// update harga otomatis saat pilih layanan
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('layanan')) {
        let harga = parseFloat(e.target.selectedOptions[0].dataset.harga) || 0;
        e.target.closest('tr').querySelector('.harga').value = harga;
        hitung();
    }
});

// hitung saat input qty
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('qty')) {
        hitung();
    }
});

// hapus baris
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('hapus')) {
        e.target.closest('tr').remove();
        hitung();
    }
});
</script>

@endsection