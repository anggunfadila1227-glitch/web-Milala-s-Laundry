<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Milala's Laundry</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-purple-100 via-pink-100 to-blue-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-extrabold text-purple-700">
            Milala’s Laundry
        </h1>

        <div class="space-x-4 text-sm">
            @auth
                <span class="text-gray-600">
                    Halo, {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="text-red-500 font-semibold hover:underline">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">
                    Login
                </a>

                <a href="{{ route('register') }}" class="text-purple-600 font-semibold hover:underline">
                    Register
                </a>
            @endguest
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="p-6">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="text-center text-xs text-gray-400 py-4">
        © {{ date('Y') }} Milala’s Laundry
    </footer>

</body>
</html>