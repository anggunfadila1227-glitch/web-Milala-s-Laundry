@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-purple-600 text-white rounded-2xl p-6 shadow">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>
        <p class="text-sm opacity-90">
            Selamat datang, {{ auth()->user()->name }}
        </p>
    </div>

    <!-- STATISTIK TRANSAKSI CUSTOMER -->
    <div class="text-lg font-semibold text-gray-700">📊 Statistik Transaksi Customer</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-5 shadow">
            <p class="text-gray-500 text-sm">Total Transaksi</p>
            <p class="text-3xl font-bold text-purple-600">
                {{ \App\Models\Transaksi::count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-5 shadow">
            <p class="text-gray-500 text-sm">Transaksi Lunas</p>
            <p class="text-3xl font-bold text-green-500">
                {{ \App\Models\Transaksi::where('status','lunas')->count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-5 shadow">
            <p class="text-gray-500 text-sm">Total Pendapatan</p>
            <p class="text-3xl font-bold text-blue-500">
                Rp {{ number_format(\App\Models\Transaksi::where('status','lunas')->sum('total')) }}
            </p>
        </div>
    </div>

    <!-- MENU ADMIN -->
    <div class="text-lg font-semibold text-gray-700">🔧 Menu Admin</div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.layanan.index') }}"
           class="bg-purple-100 hover:bg-purple-200 p-4 rounded-xl text-center font-semibold text-purple-700">
            Kelola Layanan
        </a>

        <a href="{{ route('admin.transaksi.index') }}"
           class="bg-blue-100 hover:bg-blue-200 p-4 rounded-xl text-center font-semibold text-blue-700">
            Data Transaksi Customer
        </a>

        <a href="{{ route('admin.pesanan') }}"
           class="bg-green-100 hover:bg-green-200 p-4 rounded-xl text-center font-semibold text-green-700">
            Data Pesanan
        </a>

        <a href="{{ route('admin.laporan') }}"
           class="bg-yellow-100 hover:bg-yellow-200 p-4 rounded-xl text-center font-semibold text-yellow-700">
            Laporan
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="w-full bg-red-100 hover:bg-red-200 p-4 rounded-xl font-semibold text-red-600">
                Logout
            </button>
        </form>
    </div>

</div>
@endsection
