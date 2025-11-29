@extends('template.layout')

@section('title', 'Detail Buku')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 my-10 max-w-5xl mx-auto">

    <a href="/books" class="text-sm text-gray-600 hover:text-black">&larr; Kembali</a>

    <div class="mt-6 bg-gray-100 border rounded-2xl overflow-hidden shadow-[0px_10px_0px_0px_rgba(36,36,36,1)]">

        <div class="flex flex-col md:flex-row">

            <div class="md:w-1/3">
                <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="md:w-2/3 p-8">
                <h1 class="text-3xl font-bold mb-2 text-black">{{ $book->judul }}</h1>
                <p class="text-gray-600 text-lg mb-4">oleh {{ $book->penulis }}</p>

                @if($book->kategori)
                <p class="mb-4">
                    <span class="bg-black text-white px-3 py-1 rounded-full text-xs">
                        {{ $book->kategori }}
                    </span>
                </p>
                @endif

                <p class="text-gray-700 leading-relaxed mb-6">
                    {{ $book->sinopsis ?? 'Tidak ada sinopsis.' }}
                </p>

                <div class="flex gap-3">
                    <form action="/book/{{ $book->id }}/borrow" method="POST">
                        @csrf
                        <button class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">
                            Pinjam Buku
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
