@php
    $role = request('role', 'customer')
@endphp


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Milala's Laundry</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-300 via-pink-200 to-blue-200">

    <div class="w-full max-w-sm bg-white rounded-3xl shadow-xl p-8">
        <!-- Judul -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-purple-600"> 
                {{ $role === 'admin' ? 'Admin Login' : "Milala's Laundry" }}
            </h1>
            <p class="text-sm text-gray-500">
                {{ $role === 'admin' 
                    ? 'Masuk sebagai Admin'
                    : 'Silakan login untuk laundry yaa ✨' }}
            </p>
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-500">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input type="email" name="email" required autofocus
                       class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-400 focus:outline-none">
            </div>

            <!-- Password -->
            <div>
                <label class="text-sm text-gray-600">Password</label>
                <input type="password" name="password" required
                       class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-400 focus:outline-none">
            </div>

            <!-- Remember -->
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded">
                Ingat saya
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-xl transition">
                Login
            </button>
        </form>

        <!-- Register -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-purple-600 font-semibold hover:underline">
                Daftar
            </a>
        </p>
    </div>

</body>
</html>