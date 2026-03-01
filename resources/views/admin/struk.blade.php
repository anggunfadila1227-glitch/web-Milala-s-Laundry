<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Laundry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .struk {
            width: 300px;
            margin: auto;
        }
        .center {
            text-align: center;
        }
        hr {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 2px 0;
        }
        .btn-print {
            margin-top: 12px;
            width: 100%;
            padding: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="struk">

    @php
        $total = 0;
    @endphp

    {{-- LOGO --}}
    <div class="center">
        <img src="{{ asset('images/logo-register.png') }}" width="70" alt="Logo">
        <h3>WEB LAUNDRY</h3>
        <small>Jl. Watudakon No. 123</small>
    </div>

    <hr>

    {{-- INFO STRUK --}}
    <p>
        <strong>No Struk:</strong> {{ $transaksi->kode_transaksi }}<br>
        <strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y H:i') }}
    </p>

    <hr>

    {{-- DATA CUSTOMER --}}
    <p>
        <strong>Customer:</strong><br>
        {{ $transaksi->user->name ?? '-' }}<br>
        {{ $transaksi->user->email ?? '-' }}
    </p>

    <hr>

    {{-- DETAIL LAYANAN --}}
    <table>
        @forelse ($transaksi->details as $item)

            @php
                $qty = $item->qty ?? 0;
                $harga = $item->harga ?? 0;
                $subtotal = $item->subtotal ?? ($qty * $harga);
                $total += $subtotal;
            @endphp

            <tr>
                <td colspan="2">
                    {{ $item->layanan->nama_layanan ?? 'Layanan tidak ditemukan' }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ $qty }} x Rp {{ number_format($harga,0,',','.') }}
                </td>
                <td align="right">
                    Rp {{ number_format($subtotal,0,',','.') }}
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="2" class="center">
                    <em>Tidak ada layanan</em>
                </td>
            </tr>
        @endforelse
    </table>

    <hr>

    {{-- TOTAL --}}
    <table>
        <tr>
            <td><strong>Total</strong></td>
            <td align="right">
                <strong>Rp {{ number_format($total,0,',','.') }}</strong>
            </td>
        </tr>
        <tr>
            <td>Metode Bayar</td>
            <td align="right">
                {{ strtoupper($transaksi->metode_pembayaran ?? '-') }}
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td align="right">
                {{ strtoupper($transaksi->status ?? '-') }}
            </td>
        </tr>
    </table>

    <hr>

    <p class="center">
        Terima kasih 🙏<br>
        Laundry Anda telah diterima
    </p>

    {{-- TOMBOL PRINT --}}
    <button onclick="window.print()" class="btn-print">
        🖨️ Cetak Struk
    </button>

</div>

</body>
</html>
