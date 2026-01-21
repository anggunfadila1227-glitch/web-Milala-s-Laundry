@extends('layouts.admin')

@section('title', 'Detail Layanan')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Layanan</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.layanan.index') }}">Layanan</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama Layanan</th>
                    <td>{{ $layanan->nama }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $layanan->deskripsi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($layanan->status == 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $layanan->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Update</th>
                    <td>{{ $layanan->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-warning">
                    Edit
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
