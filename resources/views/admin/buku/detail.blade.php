@extends('template.layout-admin')

@section('title', 'Detail Buku')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen bg-white">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Buku</h1>
        <a href="{{ route('buku.index') }}" 
           class="text-blue-600 hover:underline text-sm">← Kembali ke daftar buku</a>
    </div>

    <!-- CARD DETAIL -->
    <div class="bg-white rounded-xl shadow border p-6 max-w-4xl mx-auto flex flex-col md:flex-row gap-6">

        <!-- GAMBAR BUKU -->
        <div class="flex-shrink-0 w-full md:w-1/3">
            @if ($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" 
                     alt="{{ $book->judul }}" 
                     class="w-full h-80 object-cover rounded-lg shadow">
            @else
                <div class="w-full h-80 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                    Tidak ada gambar
                </div>
            @endif
        </div>

        <!-- INFORMASI DETAIL -->
        <div class="flex-1 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $book->judul }}</h2>
                <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Penulis:</span> {{ $book->penulis }}</p>
                <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Penerbit:</span> {{ $book->penerbit }}</p>
                <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Tahun Terbit:</span> {{ $book->tahun }}</p>
                <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Kategori:</span> {{ ucfirst($book->kategori) }}</p>
                <p class="text-gray-600 text-sm mb-4"><span class="font-medium">Jumlah Stok:</span> {{ $book->stok }}</p>
            </div>

            <div class="flex gap-3 mt-6">
                <a href="{{ route('buku.edit', $book->id) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">Edit Buku</a>

                <form action="{{ route('buku.destroy', $book->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                        Hapus Buku
                    </button>
                </form>
            </div>
        </div>
    </div>

</main>

@endsection
