@extends('template.layout-admin')

@section('title', 'Tambah Transaksi')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen bg-white">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Transaksi</h1>
        <a href="/admin/transaksi" 
           class="text-blue-600 hover:underline text-sm">← Kembali ke daftar transaksi</a>
    </div>

    <div class="bg-white rounded-xl shadow border p-6 max-w-2xl">

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Anggota</label>
                <select name="user_id"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Buku</label>
                <select name="book_id"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('transaksi.index') }}" 
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
