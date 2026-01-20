@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">

    <div class="w-full max-w-md bg-purple-50 rounded-2xl shadow-lg p-8">
        
        <!-- Logo / Judul -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-purple-600">
                Milala's Laundry
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Buat akun baru ✨
            </p>
        </div>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-purple-300"
                    required>
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-purple-300"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-purple-300"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-purple-300"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-lg transition">
                Sign Up
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-5 text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">
                Login
            </a>
        </div>

    </div>

</div>
@endsection