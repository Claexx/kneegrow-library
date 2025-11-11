@extends('template.layout-admin')

@section('title', 'Tambah Anggota')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen bg-white">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Anggota</h1>
        <a href="/anggotaadmin" 
           class="text-blue-600 hover:underline text-sm">← Kembali ke daftar anggota</a>
    </div>

    <div class="bg-white rounded-xl shadow border p-6 max-w-2xl">
        <form action="#" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="Masukkan email anggota"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="telepon" placeholder="08xxxxxxxxxx"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="/anggotaadmin" 
                   class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Batal</a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</main>

@endsection
