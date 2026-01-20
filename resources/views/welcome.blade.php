<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Milala's Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-500 via-pink-400 to-blue-400 flex items-center justify-center px-4">

    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 max-w-md w-full text-center">

        <!-- ICON -->
        <img 
            src="https://cdn-icons-png.flaticon.com/512/2933/2933787.png"
            class="w-32 mx-auto mb-4 animate-bounce"
            alt="Laundry Icon"
        >

        <!-- TITLE -->
        <h1 class="text-4xl font-extrabold text-purple-700 mb-2">
            Milala’s Laundry
        </h1>

        <p class="text-gray-600 mb-6 text-sm">
            Laundry bersih, wangi, cepat 💜
        </p>

        <!-- LOGIN & REGISTER -->
        <div class="space-y-4">
            <a href="{{ route('login') }}"
               class="block w-full py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-semibold transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="block w-full py-3 border-2 border-purple-600 text-purple-600 hover:bg-purple-50 rounded-xl font-semibold transition">
                Register
            </a>
        </div>

        <!-- FOOTER -->
        <p class="mt-8 text-xs text-gray-400">
            © {{ date('Y') }} Milala’s Laundry
        </p>

    </div>

</body>
</html>