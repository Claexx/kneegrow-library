@extends('template.layout')

@section('title', 'Daftar Akun')

@section('main')
<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="bg-white rounded-xl shadow border p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Daftar Akun</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/signup') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email (opsional)</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="Masukkan password"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil (opsional)</label>
                <input type="file" name="profile_photo" accept="image/*"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-400 outline-none">
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-[#242424] text-white py-2 rounded-lg hover:bg-gray-800 transition">
                    Daftar
                </button>
            </div>

            <p class="text-center text-sm text-gray-600 pt-4">
                Sudah punya akun?
                <a href="/login" class="text-blue-600 hover:underline">Masuk sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection
