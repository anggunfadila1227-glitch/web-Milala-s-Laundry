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
        }
        table {
            width: 100%;
        }
        td {
            padding: 2px 0;
        }
        .btn-print {
            margin-top: 10px;
            width: 100%;
            padding: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="struk">

    {{-- LOGO --}}
    <div class="center">
        <img src="{{ images('logo-register.png') }}" width="70">
        <h3>WEB LAUNDRY</h3>
        <small>Jl.Watudakon No. 123</small>
    </div>

    <hr>

    {{-- INFO STRUK --}}
    <p>
        <strong>No Struk:</strong> {{ $pesanan->no_struk }} <br>
        <strong>Tanggal:</strong> {{ $pesanan->tanggal ?? now()->format('d-m-Y') }}
    </p>

    <hr>

    {{-- DATA CUSTOMER --}}
    <p>
        <strong>Customer:</strong><br>
        {{ $pesanan->user->name }}<br>
        {{ $pesanan->user->email }}
    </p>

    <hr>

    {{-- DETAIL LAUNDRY --}}
    <table>
        <tr>
            <td>Jenis Laundry</td>
            <td align="right">{{ $pesanan->jenis_laundry }}</td>
        </tr>
        <tr>
            <td>Berat</td>
            <td align="right">{{ $pesanan->berat }} Kg</td>
        </tr>
        <tr>
            <td>Harga / Kg</td>
            <td align="right">Rp {{ number_format($pesanan->harga,0,',','.') }}</td>
        </tr>
    </table>

    <hr>

    {{-- TOTAL --}}
    <table>
        <tr>
            <td><strong>Total</strong></td>
            <td align="right">
                <strong>Rp {{ number_format($pesanan->total,0,',','.') }}</strong>
            </td>
        </tr>
        <tr>
            <td>Metode Bayar</td>
            <td align="right">{{ strtoupper($pesanan->metode_pembayaran) }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td align="right">{{ $pesanan->status_pembayaran }}</td>
        </tr>
    </table>

    <hr>

    {{-- QR CODE --}}
    <div class="center">
        {!! QrCode::size(80)->generate($pesanan->no_struk) !!}
        <br>
        <small>Scan untuk verifikasi</small>
    </div>

    <hr>

    <p class="center">
        Terima kasih 🙏<br>
        Laundry Anda telah selesai
    </p>

    {{-- TOMBOL PRINT --}}
    <button onclick="window.print()" class="btn-print">
        🖨️ Cetak Struk
    </button>

</div>

</body>
</html>
