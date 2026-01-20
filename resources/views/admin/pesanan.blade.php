<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan | Admin</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h3 class="mb-4">📦 Data Pesanan Laundry</h3>

    {{-- Tabel Pesanan --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $pesanan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pesanan->user->name ?? '-' }}</td>
                            <td>{{ $pesanan->tanggal }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ ucfirst($pesanan->status ?? 'proses') }}
                                </span>
                            </td>
                            <td>
                                Rp {{ number_format($pesanan->total ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
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

</body>
</html>
