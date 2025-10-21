@extends('template.layout-admin')

@section('title', 'Koleksi Buku')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen">
  <!-- TITLE -->
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Koleksi Buku</h1>
    <p class="text-gray-600 text-sm">Daftar koleksi buku yang tersedia di perpustakaan.</p>
  </div>

  <!-- KOLEKSI GRID -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    
    <!-- CARD ITEM -->
    <div class="bg-white rounded-2xl p-4 shadow-md border flex flex-col justify-between">
      <div>
        <img src="https://via.placeholder.com/150x200" alt="Buku" class="w-full h-48 object-cover rounded-lg mb-3">
        <h2 class="text-lg font-semibold text-gray-800">Laskar Pelangi</h2>
        <p class="text-sm text-gray-600 mb-2">Andrea Hirata</p>
      </div>
      <div class="flex justify-between items-center mt-2">
        <span class="text-xs text-gray-500">Tersedia: 5</span>
        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg shadow">Detail</button>
      </div>
    </div>

    <!-- CARD ITEM -->
    <div class="bg-white rounded-2xl p-4 shadow-md border flex flex-col justify-between">
      <div>
        <img src="https://via.placeholder.com/150x200" alt="Buku" class="w-full h-48 object-cover rounded-lg mb-3">
        <h2 class="text-lg font-semibold text-gray-800">Bumi Manusia</h2>
        <p class="text-sm text-gray-600 mb-2">Pramoedya A. Toer</p>
      </div>
      <div class="flex justify-between items-center mt-2">
        <span class="text-xs text-gray-500">Tersedia: 3</span>
        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg shadow">Detail</button>
      </div>
    </div>

    <!-- CARD ITEM -->
    <div class="bg-white rounded-2xl p-4 shadow-md border flex flex-col justify-between">
      <div>
        <img src="https://via.placeholder.com/150x200" alt="Buku" class="w-full h-48 object-cover rounded-lg mb-3">
        <h2 class="text-lg font-semibold text-gray-800">Filosofi Kopi</h2>
        <p class="text-sm text-gray-600 mb-2">Dewi Lestari</p>
      </div>
      <div class="flex justify-between items-center mt-2">
        <span class="text-xs text-gray-500">Tersedia: 7</span>
        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg shadow">Detail</button>
      </div>
    </div>

    <!-- CARD ITEM -->
    <div class="bg-white rounded-2xl p-4 shadow-md border flex flex-col justify-between">
      <div>
        <img src="https://via.placeholder.com/150x200" alt="Buku" class="w-full h-48 object-cover rounded-lg mb-3">
        <h2 class="text-lg font-semibold text-gray-800">Negeri 5 Menara</h2>
        <p class="text-sm text-gray-600 mb-2">Ahmad Fuadi</p>
      </div>
      <div class="flex justify-between items-center mt-2">
        <span class="text-xs text-gray-500">Tersedia: 4</span>
        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg shadow">Detail</button>
      </div>
    </div>

  </div>
</main>

@endsection
