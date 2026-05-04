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
                <div class="@if($item->denda > 0) border-l-4 border-red-500 @endif @if($item->status === 'Dipinjam' && $item->isOverdue()) border-l-4 border-yellow-500 @endif bg-white text-black rounded-xl p-5">
                    <div class="flex justify-between items-start">
                        <div class="flex-grow">
                            <p class="text-xl font-bold">{{ $item->book->judul }}</p>
                            <p class="text-sm text-gray-700 mt-2">
                                <strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                            </p>

                            @if($item->tanggal_deadline)
                                <p class="text-sm text-gray-700">
                                    <strong>Batas Kembali:</strong> 
                                    <span class="@if($item->status === 'Dipinjam' && \Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($item->tanggal_deadline))) text-red-600 font-semibold @else text-gray-700 @endif">
                                        {{ \Carbon\Carbon::parse($item->tanggal_deadline)->format('d M Y') }}
                                    </span>
                                </p>
                            @endif

                            @if($item->tanggal_kembali)
                                <p class="text-sm text-gray-700">
                                    <strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                </p>
                            @endif

                            <div class="mt-2 flex gap-4">
                                <p class="font-semibold">
                                    Status :
                                    @if ($item->status === 'Dipinjam')
                                        <span class="text-yellow-600">Dipinjam</span>
                                    @else
                                        <span class="text-green-600">Dikembalikan</span>
                                    @endif
                                </p>

                                @if($item->status === 'Dipinjam')
                                    @if($item->isOverdue())
                                        <p class="font-semibold text-red-600">
                                            ⚠️ Terlambat {{ $item->sisaHari() > 0 ? '0 hari' : abs($item->sisaHari()) . ' hari' }}
                                        </p>
                                    @else
                                        <p class="font-semibold text-blue-600">
                                            ⏰ Sisa {{ $item->sisaHari() }} hari
                                        </p>
                                    @endif
                                @endif

                                @if($item->denda > 0)
                                    <p class="font-semibold text-red-600">
                                        💰 Denda: Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div>
                            @if ($item->status === 'Dipinjam')
                                <form action="{{ route('activity.return', $item->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="bg-black text-white px-5 py-2 rounded-full hover:bg-gray-700 transition @if($item->isOverdue()) ring-2 ring-red-500 @endif">
                                        Kembalikan
                                    </button>
                                </form>
                            @endif
                        </div>
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
