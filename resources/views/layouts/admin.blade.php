<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Laundry</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-purple-700 text-white flex flex-col">

        {{-- LOGO --}}
        <div class="p-6 border-b border-purple-500">
            <h1 class="text-2xl font-bold tracking-wide">
                🧺 Mila's Laundry
            </h1>
            <p class="text-sm text-purple-200 mt-1">
                Admin Panel
            </p>
        </div>

        {{-- MENU --}}
        <nav class="flex-1 p-5 space-y-2 text-sm">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.layanan.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                👕 Data Layanan
            </a>

            <a href="{{ route('admin.transaksi.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                🧾 Transaksi
            </a>

            {{-- ✅ FIX DI SINI --}}
            <a href="{{ route('admin.pembayaran.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                💳 Pembayaran
            </a>

            <a href="{{ route('admin.laporan') }}"
               class="block px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                📈 Laporan
            </a>

        </nav>

        {{-- FOOTER --}}
        <div class="p-5 border-t border-purple-500 text-sm">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    class="w-full bg-purple-600 hover:bg-purple-800
                           py-2 rounded-lg font-semibold transition">
                    🚪 Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>
