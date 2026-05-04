@extends('template.layout-admin')

@section('title', 'Transaksi Peminjaman')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen bg-white">
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi Peminjaman</h1>
        <a href="/transaksitambah" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Tambah Transaksi</a>
    </div>

    <div class="bg-white rounded-xl shadow border overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nama Anggota</th>
                    <th class="px-6 py-3">Judul Buku</th>
                    <th class="px-6 py-3">Tanggal Pinjam</th>
                    <th class="px-6 py-3">Batas Kembali</th>
                    <th class="px-6 py-3">Tanggal Kembali</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Denda</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $i => $t)
                <tr class="border-t hover:bg-gray-50 @if($t->denda > 0) bg-yellow-50 @endif">
                    <td class="px-6 py-3">{{ $i + 1 }}</td>
                    <td class="px-6 py-3">{{ $t->user->name }}</td>
                    <td class="px-6 py-3">{{ $t->book->judul }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d M Y') }}</td>
                    <td class="px-6 py-3">
                        @if($t->tanggal_deadline)
                            {{ \Carbon\Carbon::parse($t->tanggal_deadline)->format('d M Y') }}
                        @else
                            {{ \Carbon\Carbon::parse($t->tanggal_pinjam)->addDays(7)->format('d M Y') }}
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        {{ $t->tanggal_kembali ? \Carbon\Carbon::parse($t->tanggal_kembali)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $t->status === 'Dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ $t->status }}
                        </span>
                    </td>
                    <td class="px-6 py-3">
                        @if($t->denda > 0)
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                Rp {{ number_format($t->denda, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 flex justify-center gap-2">
                        @if ($t->status === 'Dipinjam')
                        <form action="{{ route('transaksi.kembalikan', $t->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Kembalikan
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection
