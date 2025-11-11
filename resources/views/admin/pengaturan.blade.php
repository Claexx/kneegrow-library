@extends('template.layout-admin')

@section('title', 'Pengaturan')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')
<main class="pl-34 p-6 min-h-screen bg-white" x-data="{ showSuccess: false }">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan</h1>
    </div>

    {{-- Notifikasi Sukses --}}
    <div x-show="showSuccess" x-transition
        class="flex items-center gap-3 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414L9 14.414l-3.707-3.707a1 1 0 111.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
        <span class="text-sm font-medium">Pengaturan berhasil disimpan!</span>
    </div>

    {{-- Form Pengaturan --}}
    <form @submit.prevent="showSuccess = true; setTimeout(() => showSuccess = false, 3000)"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-8">

        {{-- Bagian Pengaturan Umum --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Pengaturan Umum</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Aplikasi</label>
                    <input type="text" placeholder="Masukkan nama aplikasi"
                        class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Bahasa Default</label>
                    <select class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 px-3 py-2">
                        <option>Bahasa Indonesia</option>
                        <option>English</option>
                    </select>
                </div>
            </div>
        </section>

        {{-- Bagian Akun --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Pengaturan Akun</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email</label>
                    <input type="email" placeholder="Masukkan email"
                        class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Kata Sandi Baru</label>
                    <input type="password" placeholder="Masukkan kata sandi baru"
                        class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 px-3 py-2">
                </div>
            </div>
        </section>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>

    </form>

</main>
@endsection
