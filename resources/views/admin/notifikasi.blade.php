@extends('template.layout-admin')

@section('title', 'Contoh Notifikasi')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')
<main class="pl-34 p-6 min-h-screen bg-white">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
    </div>

    {{-- Wrapper Notifikasi --}}
    <div x-data="{ showSuccess: false, showError: false, showInfo: false, showWarning: false }" class="space-y-4">

        {{-- Tombol Demo --}}
        <div class="flex flex-wrap gap-3">
            <button @click="showSuccess = true; setTimeout(() => showSuccess = false, 3000)"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Tampilkan Sukses
            </button>
            <button @click="showError = true; setTimeout(() => showError = false, 3000)"
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                Tampilkan Error
            </button>
            <button @click="showInfo = true; setTimeout(() => showInfo = false, 3000)"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Tampilkan Info
            </button>
            <button @click="showWarning = true; setTimeout(() => showWarning = false, 3000)"
                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                Tampilkan Peringatan
            </button>
        </div>

        {{-- Notifikasi Sukses --}}
        <div x-show="showSuccess" x-transition
            class="flex items-center gap-3 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414L9 14.414l-3.707-3.707a1 1 0 111.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Data berhasil disimpan!</span>
        </div>

        {{-- Notifikasi Error --}}
        <div x-show="showError" x-transition
            class="flex items-center gap-3 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.366-.446.993-.446 1.36 0l6.518 7.956c.38.463.029 1.145-.68 1.145H2.42c-.71 0-1.06-.682-.68-1.145l6.518-7.956zM9 12a1 1 0 100 2 1 1 0 000-2z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Terjadi kesalahan! Coba lagi nanti.</span>
        </div>

        {{-- Notifikasi Info --}}
        <div x-show="showInfo" x-transition
            class="flex items-center gap-3 bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8 3a1 1 0 100 2 1 1 0 000-2zm1-7a1 1 0 10-2 0v5a1 1 0 102 0V6z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Ini adalah pesan informasi umum.</span>
        </div>

        {{-- Notifikasi Warning --}}
        <div x-show="showWarning" x-transition
            class="flex items-center gap-3 bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.366-.446.993-.446 1.36 0l6.518 7.956c.38.463.029 1.145-.68 1.145H2.42c-.71 0-1.06-.682-.68-1.145l6.518-7.956zM9 12a1 1 0 100 2 1 1 0 000-2z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Perhatikan! Beberapa data belum lengkap.</span>
        </div>

    </div>

</main>
@endsection
