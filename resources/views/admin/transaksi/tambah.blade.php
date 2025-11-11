@extends('template.layout-admin')

@section('title', 'Tambah Transaksi')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')
<main class="pl-34 p-6 min-h-screen bg-gray-50">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Transaksi Peminjaman</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/transaksitambah" method="POST" class="space-y-5">
            @csrf

            <!-- Pilih Anggota -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Anggota</label>
                <select id="user_id" name="user_id" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected disabled>-- Pilih Anggota --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Buku -->
            <div>
                <label for="book_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Buku</label>
                <select id="book_id" name="book_id" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected disabled>-- Pilih Buku --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->judul }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pinjam -->
            <div>
                <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tanggal Kembali -->
            <div>
                <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between items-center mt-8">
                <a href="/transaksiadmin"
                   class="text-gray-600 hover:text-gray-900 font-medium transition">← Kembali</a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
