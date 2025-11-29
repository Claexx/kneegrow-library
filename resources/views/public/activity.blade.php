@extends('template.layout')

@section('title', 'Activity')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 py-10">

    <!-- Title -->
    <div class="py-10">
        <p class="text-6xl font-black">AKTIVITAS <span>KU</span></p>
        <p class="mt-5 ml-1">Semua aktivitas peminjaman dan pengembalian bukumu.</p>
    </div>

    <!-- Activity Section -->
    <div class="bg-[#242424] text-white rounded-2xl p-10">

        <p class="text-3xl font-black mb-6">Riwayat Aktivitas</p>

        <div class="space-y-6">

            @foreach ($transaksi as $item)
                <div class="bg-white text-black rounded-xl p-5 flex justify-between items-center">

                    <div>
                        <p class="text-xl font-bold">{{ $item->book->judul }}</p>
                        <p class="text-sm text-gray-700 mt-1">
                            Tanggal Pinjam : {{ $item->tanggal_pinjam }}
                        </p>

                        @if($item->tanggal_kembali)
                            <p class="text-sm text-gray-700">
                                Tanggal Kembali : {{ $item->tanggal_kembali }}
                            </p>
                        @endif

                        <p class="mt-2 font-semibold">
                            Status :
                            @if ($item->status === 'Dipinjam')
                                <span class="text-yellow-600">Dipinjam</span>
                            @else
                                <span class="text-green-600">Dikembalikan</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        @if ($item->status === 'Dipinjam')
                            <form action="{{ route('activity.return', $item->id) }}" method="POST">
                                @csrf
                                <button
                                    class="bg-black text-white px-5 py-2 rounded-full hover:bg-gray-700 transition">
                                    Kembalikan
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
