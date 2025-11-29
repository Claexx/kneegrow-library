@extends('template.layout-admin')

@section('title', 'Koleksi Buku')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen">
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

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <table class="min-w-full text-sm text-left text-gray-600">
      <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
          <tr>
              <th class="px-6 py-3">#</th>
              <th class="px-6 py-3">Judul</th>
              <th class="px-6 py-3">Penulis</th>
              <th class="px-6 py-3">Penerbit</th>
              <th class="px-6 py-3">Tahun</th>
              <th class="px-6 py-3">Kategori</th>
              <th class="px-6 py-3">Stok</th>
              <th class="px-6 py-3">Tanggal pembuatan</th>
              <th class="px-6 py-3 text-center">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($books as $i => $a)
          <tr class="border-t hover:bg-gray-50 transition">
              <td class="px-6 py-3">{{ $i + 1 }}</td>
              <td class="px-6 py-3 font-medium text-gray-900">{{ $a->judul }}</td>
              <td class="px-6 py-3 font-medium text-gray-900">{{ $a->penulis }}</td>
              <td class="px-6 py-3">{{ $a->penerbit }}</td>
              <td class="px-6 py-3">{{ $a->tahun }}</td>
              <td class="px-6 py-3">{{ $a->kategori }}</td>
              <td class="px-6 py-3">{{ $a->stok }}</td>
              <td class="px-6 py-3">
                  {{ $a->created_at ? $a->created_at->format('d M Y') : '-' }}
              </td>
              <td class="px-6 py-3 flex justify-center gap-2">
                  <a href="{{ route('buku.show', $a->id) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Detail</a>
                  <a href="{{ route('buku.edit', $a->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                  <form action="{{ route('buku.destroy', $a->id) }}" method="POST"
                      onsubmit="return confirm('Hapus anggota ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
  </div>

  <div class="mt-6">
    {{ $books->links() }}
  </div>

</main>

@endsection
