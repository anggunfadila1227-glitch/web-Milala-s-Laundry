@extends('layouts.admin')

@section('content')



<div class="container mt-4">

    <h3 class="mb-4">📦 Data Pesanan Laundry</h3>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Status Laundry</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $pesanan)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $pesanan->user->name ?? '-' }}</td>
                            <td>{{ $pesanan->tanggal }}</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            </td>
                            <td>
                                Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                            </td>

                            {{-- Pembayaran --}}
                            <td class="text-center">
                                @if ($pesanan->status_pembayaran === 'sudah_bayar')
                                    <span class="badge bg-success">Sudah Dibayar</span><br>
                                    <small class="text-muted">
                                        {{ strtoupper($pesanan->metode_pembayaran) }}
                                    </small>

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
                </tbody>
            </table>

        </div>
    </div>

    <a href="/admin/dashboard" class="btn btn-secondary mt-3">
        ⬅ Kembali ke Dashboard
    </a>

</div>

@endsection