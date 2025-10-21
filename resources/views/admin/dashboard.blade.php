@extends('template.layout-admin')

@section('title', 'dashboard admin')

    @section('header')
        @include('template.sidebar')
    @endsection

    @section('main')
    
    <main class="pl-34 p-6 min-h-screen">
        <!-- BENTO GRID -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
          
          <!-- CARD 1 -->
          <div class="md:col-span-4 bg-white rounded-2xl p-6 shadow-md border">
            <h2 class="text-lg font-semibold mb-2">Statistik Peminjaman</h2>
            <p class="text-sm text-gray-600">Grafik atau data ringkas peminjaman buku.</p>
          </div>
      
          <!-- CARD 2 -->
          <div class="md:col-span-2 bg-white rounded-2xl p-6 shadow-md border">
            <h2 class="text-lg font-semibold mb-2">Notifikasi</h2>
            <ul class="text-sm text-gray-600 space-y-1">
              <li>3 Buku akan jatuh tempo</li>
              <li>1 Anggota baru</li>
            </ul>
          </div>
      
          <!-- CARD 3 -->
          <div class="md:col-span-2 bg-white rounded-2xl p-6 shadow-md border">
            <h2 class="text-lg font-semibold mb-2">Anggota Baru</h2>
            <p class="text-sm text-gray-600">Daftar singkat anggota yang baru terdaftar.</p>
          </div>
      
          <!-- CARD 4 -->
          <div class="md:col-span-4 bg-white rounded-2xl p-6 shadow-md border">
            <h2 class="text-lg font-semibold mb-2">Koleksi Populer</h2>
            <div class="grid grid-cols-2 gap-2">
              <div class="bg-gray-200 rounded-lg h-24 flex items-center justify-center">📘</div>
              <div class="bg-gray-200 rounded-lg h-24 flex items-center justify-center">📕</div>
              <div class="bg-gray-200 rounded-lg h-24 flex items-center justify-center">📙</div>
              <div class="bg-gray-200 rounded-lg h-24 flex items-center justify-center">📗</div>
            </div>
          </div>
      
        </div>
      </main>
      
    
    
@endsection