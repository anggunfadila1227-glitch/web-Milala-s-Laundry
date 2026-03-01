@extends('layouts.admin')
<<<<<<< HEAD

@section('content')
=======

@section('content')


>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6

<div class="container mt-4">

    <h3 class="mb-4">📊 Laporan Transaksi Laundry</h3>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($transaksis as $transaksi)

                    @php
                        $total = $transaksi->details->sum(function ($d) {
                            return ($d->harga ?? 0) * ($d->qty ?? 0);
                        });
                    @endphp

<<<<<<< HEAD
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->user->name ?? '-' }}</td>
                        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                        <td class="text-center">
                            <span class="badge bg-success">
                                {{ $transaksi->status }}
                            </span>
                        </td>
                        <td>
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            {{ strtoupper($transaksi->metode_pembayaran ?? '-') }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Data transaksi belum ada
                        </td>
                    </tr>
                @endforelse
=======
                                @elseif (in_array($pesanan->status, ['selesai', 'diambil','lunas']));
                                    <form action="/admin/pesanan/{{ $pesanan->id }}/bayar" method="POST">
                                        @csrf
                                        <select name="metode_pembayaran"
                                                class="form-select form-select-sm mb-2"
                                                required>
                                            <option value="">Pilih</option>
                                            <option value="cash">Cash</option>
                                            <option value="qris">QRIS</option>
                                        </select>
                                        <button class="btn btn-sm btn-primary w-100">
                                            Bayar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Belum bisa bayar</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data pesanan belum ada
                            </td>
                        </tr>
                    @endforelse
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
                </tbody>
            </table>

            {{-- TOTAL PENDAPATAN --}}
            <div class="text-end fw-bold mt-3">
                Total Pendapatan :
                <span class="text-success">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </span>
            </div>

        </div>
    </div>

    <a href="/admin/dashboard" class="btn btn-secondary mt-3">
        ⬅ Kembali ke Dashboard
    </a>

</div>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
