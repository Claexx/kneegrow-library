@extends('template.layout-admin')

@section('title', 'Koleksi Buku')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen">
  <!-- TITLE -->
  <div class="flex justify-between">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Koleksi Buku</h1>
      <p class="text-gray-600 text-sm">Daftar koleksi buku yang tersedia di perpustakaan.</p>
    </div>
    <div class="bg-blue-600 w-fit h-fit px-3 py-2 rounded-xl">
      <a href="{{ route('buku.create') }}" class="text-white">
        + tambah buku
      </a>
    </div>
  </div>
  
  <!-- KOLEKSI GRID -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

    @forelse ($books as $book)
      <!-- CARD ITEM -->
      <div class="bg-white rounded-2xl p-4 shadow-md border flex flex-col justify-between">
        <div>
          {{-- Gambar buku --}}
          @if ($book->image)
            <img src="{{ asset('storage/' . $book->image) }}" 
                 alt="{{ $book->judul }}" 
                 class="w-full h-48 object-cover rounded-lg mb-3">
          @else
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center rounded-lg mb-3 text-gray-400 text-sm">
              Tidak ada gambar
            </div>
          @endif

          <h2 class="text-lg font-semibold text-gray-800">{{ $book->judul }}</h2>
          <p class="text-sm text-gray-600 mb-2">{{ $book->penulis }}</p>
        </div>
        <div class="flex justify-between items-center mt-2">
          <span class="text-xs text-gray-500">Tersedia: {{ $book->stok }}</span>
          <a href="{{ route('buku.show', $book->id) }}" 
             class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg shadow">
            Detail
          </a>
        </div>
      </div>
    @empty
      <p class="text-gray-500 text-center col-span-4 py-10">Belum ada buku yang ditambahkan.</p>
    @endforelse

  </div>

  <!-- PAGINATION -->
  <div class="mt-6">
    {{ $books->links() }}
  </div>

</main>

@endsection
