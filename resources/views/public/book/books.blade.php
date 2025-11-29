@extends('template.layout')

@section('title', 'Koleksi Buku')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 my-10">
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-4xl font-bold">Koleksi Buku</h1>
        <a href="/book/create"
           class="bg-black text-white px-5 py-2 rounded-full hover:bg-gray-800 transition">
            + Tambah Buku
        </a>
    </div>

    <form action="/book" method="GET" class="mb-10">
        <input type="text" name="search" placeholder="Cari judul / penulis..."
               class="w-full sm:w-96 px-4 py-2 border rounded-full focus:ring-2 focus:ring-black outline-none"
               value="{{ request('search') }}">
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center">
        @foreach ($books as $book)
            <div class="w-60 bg-gray-100 rounded-2xl border 
                        hover:shadow-[0px_10px_0px_0px_rgba(36,36,36,1)] 
                        hover:-translate-y-1 transition duration-300 ease-in-out overflow-hidden">

                <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}"
                     alt="{{ $book->judul }}"
                     class="w-full h-72 object-cover rounded-t-2xl">

                <div class="p-4 text-center">
                    <h2 class="text-black font-semibold text-base truncate">{{ $book->judul }}</h2>
                    <p class="text-gray-600 text-sm mb-3 truncate">oleh {{ $book->penulis }}</p>

                    <div class="flex gap-2">
                        <a href="{{ route('buku.showlp', $book->id) }}"
                           class="w-1/2 bg-white border border-gray-300 text-gray-700 text-sm px-3 py-2 rounded-full hover:bg-gray-200 transition">
                            Detail
                        </a>

                        <form action="/book/{{ $book->id }}/borrow" method="POST" class="w-1/2">
                            @csrf
                            <button type="submit"
                                class="bg-black text-white text-sm px-3 py-2 rounded-full hover:bg-gray-800 transition w-full">
                                Pinjam
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($books->hasPages())
        <div class="flex justify-center mt-10">
            {{ $books->links() }}
        </div>
    @endif
</div>

@endsection
