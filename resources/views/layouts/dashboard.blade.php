<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Milala's Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-purple-100 via-pink-100 to-blue-100 min-h-screen">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-xl rounded-tr-3xl rounded-br-3xl p-6">

        <!-- LOGO -->
        <h2 class="text-2xl font-extrabold text-purple-600 mb-8">
            Milala’s 👕
        </h2>

        <!-- MENU -->
        <nav class="space-y-2">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl hover:bg-purple-100 font-semibold text-purple-700">
                📊 Dashboard
            </a>

            <!-- TRANSAKSI -->
            <div>
                <p class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">
                    Transaksi
                </p>

                <a href="{{ route('transaksi.index') }}"
                   class="block px-6 py-2 rounded-lg hover:bg-purple-100 text-gray-700">
                    📦 Transaksi Saya
                </a>


            </div>

            <!-- PEMBAYARAN -->
            <a href="{{ route('pembayaran.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-purple-100 font-semibold text-gray-700">
                💳 Pembayaran
            </a>

        </nav>

        <br>
        <br>
        <br>
        <br>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" class="mt-10">
            @csrf
            <button
                class="w-full py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition">
                Logout
            </button>
        </form>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">
        <div class="bg-white rounded-3xl shadow-lg p-8 min-h-full">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>