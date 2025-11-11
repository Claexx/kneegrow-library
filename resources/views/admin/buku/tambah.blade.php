@extends('template.layout-admin')

@section('title', 'Tambah Buku')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen bg-white">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Buku</h1>
        <a href="/koleksiadmin" 
           class="text-blue-600 hover:underline text-sm">← Kembali ke daftar buku</a>
    </div>

    <div class="bg-white rounded-xl shadow border p-6 max-w-2xl">
        {{-- Tambahkan enctype untuk upload gambar --}}
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                <input type="text" name="judul" placeholder="Masukkan judul buku"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                <input type="text" name="penulis" placeholder="Nama penulis buku"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" placeholder="Nama penerbit buku"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                <input type="number" name="tahun" placeholder="Contoh: 2023"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">Pilih kategori</option>
                    <option value="novel">Novel</option>
                    <option value="biografi">Biografi</option>
                    <option value="pelajaran">Pelajaran</option>
                    <option value="umum">Umum</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok</label>
                <input type="number" name="stok" placeholder="Masukkan jumlah stok buku"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
                <input type="file" name="image" 
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="/koleksiadmin" 
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
