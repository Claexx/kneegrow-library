@extends('template.layout')

@section('title', 'Koleksi Buku')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-4 sm:mx-6 lg:mx-10 my-8 sm:my-10">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold">Koleksi Buku</h1>
    </div>

    <!-- Search Form -->
    <form action="{{ route('books.index') }}" method="GET" class="mb-8">
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" id="search" placeholder="Cari judul / penulis..."
                   class="flex-1 px-4 sm:px-5 py-2 sm:py-3 border-2 border-gray-300 rounded-full focus:ring-2 focus:ring-[#242424] focus:border-transparent outline-none text-sm sm:text-base transition"
                   value="{{ request('search') }}">
            <button type="submit" class="px-6 sm:px-8 py-2 sm:py-3 bg-[#242424] text-white rounded-full hover:bg-gray-800 transition font-semibold text-sm sm:text-base whitespace-nowrap">
                Cari
            </button>
        </div>
    </form>

    <!-- Category Filter -->
    <div class="mb-8">
        <p class="text-sm sm:text-base font-semibold text-gray-700 mb-3">Filter Kategori:</p>
        <div class="flex flex-wrap gap-2 sm:gap-3">
            <form action="{{ route('books.index') }}" method="GET" class="inline">
                <button type="submit" class="px-4 sm:px-6 py-2 rounded-full bg-[#242424] text-white text-sm sm:text-base font-semibold transition hover:shadow-lg {{ !request('category') ? 'ring-2 ring-offset-2 ring-[#242424]' : '' }}">
                    Semua
                </button>
            </form>
            @foreach(['fiksi', 'non-fiksi', 'akademik', 'referensi'] as $cat)
                <form action="{{ route('books.index') }}" method="GET" class="inline">
                    <input type="hidden" name="category" value="{{ $cat }}">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit" class="px-4 sm:px-6 py-2 rounded-full border-2 border-[#242424] text-[#242424] text-sm sm:text-base font-semibold transition hover:bg-gray-100 {{ request('category') === $cat ? 'bg-[#242424] text-white' : 'bg-white' }}">
                        {{ ucfirst(str_replace('-', ' ', $cat)) }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>

    <!-- Books Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8 justify-items-center mb-10">
        @if($books->count() > 0)
            @foreach ($books as $book)
                <div class="w-full sm:w-60 bg-white rounded-2xl border-2 border-gray-200 
                            hover:shadow-[0px_10px_20px_0px_rgba(36,36,36,0.15)] 
                            hover:-translate-y-2 transition duration-300 ease-in-out overflow-hidden">

                    <div class="relative overflow-hidden h-72 bg-gray-200">
                        <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}"
                             alt="{{ $book->judul }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        @if($book->kategori)
                            <div class="absolute top-3 right-3 bg-[#86FF79] text-[#242424] px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">
                                {{ ucfirst($book->kategori) }}
                            </div>
                        @endif
                    </div>

                    <div class="p-4 sm:p-5 text-center">
                        <h2 class="text-black font-semibold text-sm sm:text-base line-clamp-2 mb-2">{{ $book->judul }}</h2>
                        <p class="text-gray-600 text-xs sm:text-sm mb-4 line-clamp-1">{{ $book->penulis }}</p>

                        <div class="flex gap-2 flex-col sm:flex-row">
                            <a href="{{ route('buku.showlp', $book->id) }}"
                               class="w-full bg-white border-2 border-[#242424] text-[#242424] text-xs sm:text-sm px-3 py-2 rounded-full hover:bg-[#242424] hover:text-white transition font-semibold">
                                Detail
                            </a>

                            <form action="/book/{{ $book->id }}/borrow" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="bg-[#86FF79] text-[#242424] text-xs sm:text-sm px-3 py-2 rounded-full hover:bg-[#7ae870] transition w-full font-semibold">
                                    Pinjam
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500 text-lg">Tidak ada buku yang ditemukan</p>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if ($books->hasPages())
        <div class="flex justify-center">
            {{ $books->links() }}
        </div>
    @endif
</div>

@endsection
