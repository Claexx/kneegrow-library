@extends('template.layout')

@section('title', 'Detail Buku')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-4 sm:mx-6 lg:mx-10 my-8 sm:my-10 max-w-5xl mx-auto">

    <a href="/books" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-[#242424] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Koleksi
    </a>

    <div class="mt-8 bg-white border-2 border-gray-200 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition">

        <div class="flex flex-col lg:flex-row">

            <!-- Book Image -->
            <div class="lg:w-1/3 h-96 lg:h-auto bg-gray-200 flex items-center justify-center overflow-hidden">
                <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}"
                     class="w-full h-full object-cover hover:scale-105 transition duration-300"
                     alt="{{ $book->judul }}">
            </div>

            <!-- Book Details -->
            <div class="lg:w-2/3 p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <div class="mb-4">
                        @if($book->kategori)
                        <span class="inline-block bg-[#86FF79] text-[#242424] px-4 py-1 rounded-full text-xs sm:text-sm font-bold">
                            {{ ucfirst($book->kategori) }}
                        </span>
                        @endif
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-3 text-black">{{ $book->judul }}</h1>
                    <p class="text-base sm:text-lg text-gray-700 mb-6 font-semibold">oleh <span class="text-[#242424] font-bold">{{ $book->penulis }}</span></p>

                    <!-- Book Info Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mb-8 py-6 border-y-2 border-gray-200">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500 font-semibold uppercase tracking-wider">Penerbit</p>
                            <p class="text-sm sm:text-base font-semibold text-gray-800 mt-2">{{ $book->penerbit ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500 font-semibold uppercase tracking-wider">Tahun Terbit</p>
                            <p class="text-sm sm:text-base font-semibold text-gray-800 mt-2">{{ $book->tahun ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500 font-semibold uppercase tracking-wider">Stok Tersedia</p>
                            <p class="text-sm sm:text-base font-semibold mt-2">
                                @if($book->stok > 0)
                                    <span class="text-green-600">{{ $book->stok }} Buku</span>
                                @else
                                    <span class="text-red-600">Tidak Tersedia</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500 font-semibold uppercase tracking-wider">Kategori</p>
                            <p class="text-sm sm:text-base font-semibold text-gray-800 mt-2">{{ ucfirst($book->kategori ?? 'Umum') }}</p>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div class="mb-8">
                        <h2 class="text-lg sm:text-xl font-bold text-black mb-4">Deskripsi</h2>
                        <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                            {{ $book->sinopsis ?? 'Tidak ada deskripsi tersedia untuk buku ini.' }}
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <form action="/book/{{ $book->id }}/borrow" method="POST" class="flex-1">
                        @csrf
                        @if($book->stok > 0)
                            <button type="submit" class="w-full bg-[#86FF79] text-[#242424] font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-full hover:bg-[#7ae870] transition shadow-lg hover:shadow-xl text-sm sm:text-base">
                                📚 Pinjam Buku
                            </button>
                        @else
                            <button type="button" disabled class="w-full bg-gray-300 text-gray-600 font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-full cursor-not-allowed text-sm sm:text-base">
                                Stok Habis
                            </button>
                        @endif
                    </form>
                    <a href="/books" class="flex-1 bg-white border-2 border-[#242424] text-[#242424] font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-full hover:bg-[#242424] hover:text-white transition text-center text-sm sm:text-base">
                        Lihat Buku Lain
                    </a>
                    @if($book->ebook)
                        <a href="{{ route('buku.download', $book->id) }}" class="flex-1 bg-[#242424] text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-full hover:opacity-90 transition text-center text-sm sm:text-base">
                            ⬇️ Unduh / Install E-Book
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
