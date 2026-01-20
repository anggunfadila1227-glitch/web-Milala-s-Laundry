<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Laundry' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-purple-100 to-pink-100 min-h-screen">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg p-6">
        <h1 class="text-2xl font-bold text-purple-600 mb-6">
            🧺 Admin Laundry
        </h1>

        <!-- MENU -->
        <nav class="space-y-2">
            {{ $menu }}
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">
        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">
                {{ $header ?? '' }}
            </h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

        <!-- PAGE CONTENT -->
        <div class="bg-white rounded-2xl shadow p-6">
            {{ $slot }}
        </div>
    </main>

</div>

</body>
</html>