@extends('template.layout-admin')

@section('title', 'Edit Buku')

@section('header')
@include('template.sidebar')
@endsection

@section('main')
<main class="pl-34 p-6 min-h-screen">
    <a href="{{ route('buku.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Kembali</a>
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Edit Buku</h1>
        <form action="{{ route('buku.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="font-semibold">Judul</label>
                    <input type="text" name="judul" value="{{ $book->judul }}"
                           class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="font-semibold">Penulis</label>
                    <input type="text" name="penulis" value="{{ $book->penulis }}"
                           class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="font-semibold">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ $book->penerbit }}"
                           class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="font-semibold">Tahun Terbit</label>
                    <input type="number" name="tahun" value="{{ $book->tahun }}"
                           class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="font-semibold">Kategori</label>
                    <input type="text" name="kategori" value="{{ $book->kategori }}"
                           class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sinopsis</label>
                    <textarea 
                        name="sinopsis" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" 
                        rows="5">{{ $book->sinopsis }}</textarea>
                </div>
                <div>
                    <label class="font-semibold">Stok</label>
                    <input type="number" name="stok" value="{{ $book->stok }}"
                           class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="font-semibold">Gambar Buku</label>
                    <input type="file" name="image"
                           class="w-full px-4 py-2 border rounded-lg">
                    @if ($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}"
                             class="w-24 h-32 object-cover rounded-lg mt-2">
                    @endif
                </div>
                <div>
                    <label class="font-semibold">Upload E-Book (PDF / EPUB)</label>
                    <input type="file" name="ebook" accept=".pdf,.epub" class="w-full px-4 py-2 border rounded-lg">
                    @if ($book->ebook)
                        <p class="text-xs text-gray-500 mt-2">Ebook saat ini: <a href="{{ asset('storage/'.$book->ebook) }}" target="_blank" class="text-blue-600 hover:underline">Lihat / Unduh</a></p>
                    @endif
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('buku.index') }}" 
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
