@extends('template.layout')

@section('title', 'Koleksi Buku')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 my-10">
    <h1 class="text-4xl font-bold mb-8">Koleksi Buku</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center">
        @foreach ($books as $book)
            <div class="w-60 bg-gray-100 rounded-2xl border 
                        hover:shadow-[0px_10px_0px_0px_rgba(36,36,36,1)] 
                        hover:-translate-y-1 transition duration-300 ease-in-out overflow-hidden">
    
                {{-- Gambar Buku --}}
                <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}"
                     alt="{{ $book->judul }}"
                     class="w-full h-72 object-cover rounded-t-2xl">
    
                {{-- Info Buku --}}
                <div class="p-4 text-center">
                    <h2 class="text-black font-semibold text-base truncate">{{ $book->judul }}</h2>
                    <p class="text-gray-600 text-sm mb-3 truncate">oleh {{ $book->penulis }}</p>
    
                    <form action="/book/{{ $book->id }}/borrow" method="POST">
                        @csrf
                        <button type="submit"
                                class="bg-black text-white text-sm px-4 py-2 rounded-full hover:bg-gray-800 transition w-full">
                            Pinjam Buku
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    
    {{-- Pagination --}}
    @if ($books->hasPages())
        <div class="flex justify-center mt-10">
            {{ $books->links() }}
        </div>
    @endif    
</div>

@endsection
