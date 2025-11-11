@extends('template.layout')

@section('title', 'Login')

@section('main')
<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="bg-white rounded-xl shadow border p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Login Akun</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="Masukkan password"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none"
                    required>
            </div>

            <div class="pt-2">
                <a href="{{ route('auth.google') ?? '#' }}"
                    class="w-full flex items-center justify-center border border-gray-300 rounded-lg py-2 hover:bg-gray-100">
                    <img src="https://developers.google.com/identity/images/g-logo.png" width="20" class="mr-2">
                    Login dengan Google
                </a>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-600">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    Ingat saya
                </label>
                <a href="#" class="hover:text-blue-600 transition">Lupa password?</a>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-[#242424] text-white py-2 rounded-lg hover:bg-gray-800 transition">
                    Masuk
                </button>
            </div>

            <p class="text-center text-sm text-gray-600 pt-4">
                Belum punya akun?
                <a href="/signup" class="text-blue-600 hover:underline">Daftar sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection
