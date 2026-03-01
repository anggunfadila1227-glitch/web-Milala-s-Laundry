@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">

        <h2 class="text-xl font-bold mb-4">Tambah Transaksi</h2>

<<<<<<< HEAD
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <table class="w-full border border-gray-300" id="table-transaksi">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">Layanan</th>
                        <th class="border p-2">Jenis Cucian</th>
                        <th class="border p-2">Qty</th>
                        <th class="border p-2">Harga</th>
                        <th class="border p-2">Subtotal</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="border p-2">
                            <select name="items[0][layanan_id]" class="layanan border p-2 w-full" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach ($layanans as $layanan)
                                    <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga }}">
                                        {{ $layanan->nama_layanan }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td class="border p-2">
                            <select name="items[0][jenis_cucian_id]" class="border p-2 w-full" required>
                                <option value="">-- Pilih Jenis Cucian --</option>
                                @foreach ($jenisCucians as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td class="border p-2">
                            <input type="number" name="items[0][qty]" value="1" step="0.1"
                                class="qty border p-2 w-full" required>
                        </td>

                        <td class="border p-2">
                            <input type="number" name="items[0][harga]" class="harga border p-2 w-full" value="0"
                                readonly>
                        </td>

                        <td class="border p-2">
                            <input type="number" name="items[0][subtotal]" class="subtotal border p-2 w-full"
                                value="0" readonly>
                        </td>
=======
{{-- TAMPILKAN ERROR VALIDASI --}}
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transaksi.store') }}" method="POST"
      class="bg-white rounded-2xl shadow p-6 max-w-3xl space-y-6">
    @csrf

    <table class="w-full text-sm" id="table-transaksi">
        <thead>
            <tr class="bg-purple-600 text-white">
                <th class="p-3">Layanan</th>
                <th class="p-3">Jenis Cucian</th>
                <th class="p-3">Qty (kg)</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Subtotal</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                {{-- LAYANAN --}}
                <td class="p-2">
                    <select name="items[0][layanan_id]"
                        class="w-full border rounded-xl p-2 layanan" required>
                        <option value="">-- pilih layanan --</option>
                        @foreach ($layanans as $l)
                            <option value="{{ $l->id }}"
                                data-harga="{{ $l->harga }}">
                                {{ $l->nama_layanan }} — Rp {{ number_format($l->harga) }}
                            </option>
                        @endforeach
                    </select>
                </td>

                {{-- JENIS CUCIAN --}}
<td class="p-2">
    <select name="items[0][jenis_cucian_id]"
            class="w-full border rounded-xl p-2" required>
        <option value="">-- pilih jenis cucian --</option>
        @foreach ($jenisCucians as $jc)
            <option value="{{ $jc->id }}">{{ $jc->nama }}</option>
        @endforeach
    </select>
</td>
                {{-- QTY --}}
                <td class="p-2">
                    <input type="number" name="items[0][qty]"
                        step="0.1" value="1"
                        class="w-full border rounded-xl p-2 qty" required>
                </td>

                {{-- HARGA --}}
                <td class="p-2">
                    <input type="number"
                        class="w-full border rounded-xl p-2 harga" readonly>
                </td>

                {{-- SUBTOTAL --}}
                <td class="p-2">
                    <input type="number"
                        class="w-full border rounded-xl p-2 subtotal" readonly>
                </td>

                {{-- AKSI --}}
                <td class="p-2 text-center">
                    <button type="button" class="hapus text-red-600">❌</button>
                </td>
            </tr>
        </tbody>
    </table>
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

                        <td class="border p-2 text-center">
                            <button type="button" class="hapus text-red-600">❌</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" id="addRow" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Baris
            </button>

            <div class="mt-4 font-bold">
                Total: Rp <span id="total">0</span>
            </div>

            <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded">
                Simpan Transaksi
            </button>

        </form>
    </div>

<<<<<<< HEAD
    <script>
        let jenisCucians = @json($jenisCucians);
        let rowIndex = 1;

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('#table-transaksi tbody tr').forEach(tr => {
                let qty = parseFloat(tr.querySelector('.qty').value) || 0;
                let harga = parseFloat(tr.querySelector('.harga').value) || 0;
                let subtotal = qty * harga;
                tr.querySelector('.subtotal').value = subtotal;
                total += subtotal;
            });
            document.getElementById('total').innerText = total.toLocaleString('id-ID');
        }
=======
    <div class="mt-6 text-right">
        <button type="submit"
            class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700">
            💾 Simpan Transaksi
        </button>
    </div>
</form>
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

        // set harga saat layanan dipilih
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('layanan')) {
                let harga = parseFloat(
                    e.target.selectedOptions[0].dataset.harga
                ) || 0;

                let tr = e.target.closest('tr');
                tr.querySelector('.harga').value = harga;
                hitungTotal();
            }
        });

<<<<<<< HEAD
        // hitung ulang saat qty diubah
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty')) {
                hitungTotal();
            }
        });

        // hapus baris
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus')) {
                e.target.closest('tr').remove();
                hitungTotal();
            }
        });

        // tambah baris
        document.getElementById('addRow').addEventListener('click', function() {
            let tbody = document.querySelector('#table-transaksi tbody');

            let jenisOption = `<option value="">-- Pilih Jenis Cucian --</option>`;
            jenisCucians.forEach(j => {
                jenisOption += `<option value="${j.id}">${j.nama_jenis}</option>`;
            });

            let layananOptions = `
        <option value="">-- Pilih Layanan --</option>
        @foreach ($layanans as $l)
            <option value="{{ $l->id }}" data-harga="{{ $l->harga }}">
                {{ $l->nama_layanan }}
            </option>
        @endforeach
=======
// TAMBAH BARIS
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
                        data-harga="{{ $l->harga }}">
                        {{ $l->nama_layanan }} — Rp {{ number_format($l->harga) }}
                    </option>
                @endforeach
            </select>
        </td>

        <td class="p-2">
            <select name="items[${row}][jenis_cucian_id]"
                class="w-full border rounded-xl p-2" required>
                <option value="">-- pilih jenis cucian --</option>
                @foreach ($layanans as $l)
                    <option value="{{ $l->id }}">{{ $l->jenis_cucian }}</option>
                @endforeach
            </select>
        </td>

        <td class="p-2">
            <input type="number" name="items[${row}][qty]"
                step="0.1" value="1"
                class="w-full border rounded-xl p-2 qty" required>
        </td>

        <td class="p-2">
            <input type="number"
                class="w-full border rounded-xl p-2 harga" readonly>
        </td>

        <td class="p-2">
            <input type="number"
                class="w-full border rounded-xl p-2 subtotal" readonly>
        </td>

        <td class="p-2 text-center">
            <button type="button" class="hapus text-red-600">❌</button>
        </td>
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
    `;

<<<<<<< HEAD
            tbody.insertAdjacentHTML('beforeend', `
<tr>
<td class="border p-2">
<select name="items[${rowIndex}][layanan_id]" class="layanan border p-2 w-full" required>
${layananOptions}
</select>
</td>
<td class="border p-2">
<select name="items[${rowIndex}][jenis_cucian_id]" class="border p-2 w-full" required>
${jenisOption}
</select>
</td>
<td class="border p-2">
<input type="number" name="items[${rowIndex}][qty]" value="1" step="0.1" class="qty border p-2 w-full" required>
</td>
<td class="border p-2">
<input type="number" name="items[${rowIndex}][harga]" class="harga border p-2 w-full" value="0" readonly>
</td>
<td class="border p-2">
<input type="number" name="items[${rowIndex}][subtotal]" class="subtotal border p-2 w-full" value="0" readonly>
</td>
<td class="border p-2 text-center">
<button type="button" class="hapus text-red-600">❌</button>
</td>
</tr>
`);
            rowIndex++;
        });
    </script>
=======
// AUTO SET HARGA
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('layanan')) {
        let harga = parseFloat(e.target.selectedOptions[0].dataset.harga) || 0;
        e.target.closest('tr').querySelector('.harga').value = harga;
        hitung();
    }
});

// HITUNG QTY
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('qty')) {
        hitung();
    }
});

// HAPUS BARIS
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('hapus')) {
        e.target.closest('tr').remove();
        hitung();
    }
});
</script>

>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
@endsection
