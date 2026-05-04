@extends('template.layout')

@section('title', 'Profil Saya')

@section('header')
    @include('template.navbar')
@endsection

@section('main')
<div class="container section">

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- Bagian header profil --}}
    <div class="py-10 flex flex-col md:flex-row items-center md:items-start gap-10">
        {{-- Foto profil atau inisial --}}
        @php
            $colors = ['bg-blue-600', 'bg-green-600', 'bg-yellow-500', 'bg-red-600', 'bg-purple-600', 'bg-pink-600'];
            $color = $colors[crc32(Auth::user()->username) % count($colors)];
        @endphp

        <div class="flex flex-col items-center md:items-start">
            @if (Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                     class="w-40 h-40 rounded-full object-cover border-4 border-[#242424]" 
                     alt="Foto Profil">
            @else
                <div class="w-40 h-40 rounded-full flex items-center justify-center text-white text-6xl font-black {{ $color }}">
                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
            @endif

            <div class="mt-5 text-center md:text-left">
                <p class="text-4xl font-black">{{ Auth::user()->name ?? Auth::user()->username }}</p>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                <p class="mt-2 text-sm font-semibold bg-[#242424] text-white px-3 py-1 rounded-full w-fit mx-auto md:mx-0">
                    {{ Auth::user()->is_admin ? 'Administrator' : 'Pengguna' }}
                </p>
            </div>
        </div>

        {{-- Informasi profil --}}
        <div class="flex-1">
            <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-200">
                <p class="text-3xl font-black mb-6 border-b pb-2">Informasi Akun</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-500 text-sm">Nama Lengkap</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Username</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->username }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Nomor Telepon</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->notelp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tipe Akun</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->is_admin ? 'Administrator' : 'Pengguna Biasa' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal Bergabung</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('profile.edit') }}" class="w-full sm:w-fit px-6 py-2 bg-[#242424] text-white rounded-full font-medium hover:bg-[#3b3b3b] transition-all duration-200">
                        Edit Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-fit">
                        @csrf
                        <button type="submit" class="w-full px-6 py-2 bg-red-500 text-white rounded-full font-medium hover:bg-red-600 transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Seksi tambahan: aktivitas atau catatan user (opsional) --}}
    <div class="py-10 mx-2 md:mx-0">
        <p class="text-3xl font-black mb-6">Statistik Peminjaman</p>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            {{-- Total Buku Dipinjam --}}
            <div class="bg-blue-100 rounded-2xl p-6 border border-blue-300 hover:shadow-lg transition">
                <p class="text-gray-600 text-sm font-semibold">Buku Sedang Dipinjam</p>
                <p class="text-4xl font-black text-blue-600 mt-2">
                    {{ Auth::user()->transactions()->where('status', 'Dipinjam')->count() }}
                </p>
            </div>

            {{-- Total Buku Dikembalikan --}}
            <div class="bg-green-100 rounded-2xl p-6 border border-green-300 hover:shadow-lg transition">
                <p class="text-gray-600 text-sm font-semibold">Buku Dikembalikan</p>
                <p class="text-4xl font-black text-green-600 mt-2">
                    {{ Auth::user()->transactions()->where('status', 'Dikembalikan')->count() }}
                </p>
            </div>

            {{-- Total Denda --}}
            <div class="bg-red-100 rounded-2xl p-6 border border-red-300 hover:shadow-lg transition">
                <p class="text-gray-600 text-sm font-semibold">Total Denda</p>
                <p class="text-2xl font-black text-red-600 mt-2">
                    Rp {{ number_format(Auth::user()->transactions()->sum('denda'), 0, ',', '.') }}
                </p>
            </div>

            {{-- Keterlambatan Aktif --}}
            <div class="bg-yellow-100 rounded-2xl p-6 border border-yellow-300 hover:shadow-lg transition">
                <p class="text-gray-600 text-sm font-semibold">Keterlambatan Aktif</p>
                <p class="text-4xl font-black text-yellow-600 mt-2">
                    @php
                        $overdueCount = 0;
                        foreach(Auth::user()->transactions()->where('status', 'Dipinjam')->get() as $trans) {
                            if($trans->isOverdue()) $overdueCount++;
                        }
                    @endphp
                    {{ $overdueCount }}
                </p>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="py-10 mx-2 md:mx-0">
        <p class="text-3xl font-black mb-6">Aktivitas Terbaru</p>
        
        @php
            $activeTransactions = Auth::user()->transactions()->where('status', 'Dipinjam')->with('book')->latest()->get();
        @endphp

        @if($activeTransactions->count() > 0)
            <div class="space-y-4">
                @foreach($activeTransactions as $transaction)
                    <div class="bg-white rounded-2xl p-6 border @if($transaction->isOverdue()) border-red-300 bg-red-50 @elseif($transaction->sisaHari() <= 2) border-yellow-300 bg-yellow-50 @else border-gray-300 @endif shadow hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-grow">
                                <p class="font-black text-lg">{{ $transaction->book->judul }}</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-3 text-sm">
                                    <div>
                                        <p class="text-gray-600 text-xs">Tanggal Pinjam</p>
                                        <p class="font-semibold">{{ \Carbon\Carbon::parse($transaction->tanggal_pinjam)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs">Batas Kembali</p>
                                        <p class="font-semibold @if($transaction->isOverdue()) text-red-600 @elseif($transaction->sisaHari() <= 2) text-yellow-600 @endif">
                                            {{ \Carbon\Carbon::parse($transaction->tanggal_deadline)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs">Sisa Hari</p>
                                        <p class="font-semibold @if($transaction->isOverdue()) text-red-600 @elseif($transaction->sisaHari() <= 2) text-yellow-600 @endif">
                                            @if($transaction->isOverdue())
                                                ⚠️ Terlambat {{ abs($transaction->sisaHari()) }} hari
                                            @else
                                                ✅ {{ $transaction->sisaHari() }} hari
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs">Status</p>
                                        <p class="font-semibold">
                                            <span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                                Dipinjam
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <form action="{{ route('activity.return', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-2 bg-[#242424] text-white rounded-full font-medium hover:bg-[#3b3b3b] transition @if($transaction->isOverdue()) ring-2 ring-red-500 @endif">
                                        Kembalikan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex-1 bg-gray-100 rounded-2xl p-6 border">
                <p class="font-bold text-xl mb-2">Buku yang Dipinjam</p>
                <p class="text-gray-600">Kamu belum meminjam buku apa pun saat ini.</p>
            </div>
        @endif
    </div>

    {{-- Riwayat Transaksi Terbaru --}}
    <div class="py-10 mx-2 md:mx-0">
        <p class="text-3xl font-black mb-6">Riwayat Transaksi Terakhir</p>
        
        @php
            $recentTransactions = Auth::user()->transactions()->with('book')->latest()->take(5)->get();
        @endphp

        @if($recentTransactions->count() > 0)
            <div class="bg-white rounded-2xl shadow border overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">Judul Buku</th>
                            <th class="px-6 py-3">Tanggal Pinjam</th>
                            <th class="px-6 py-3">Tanggal Kembali</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $trans)
                        <tr class="border-t hover:bg-gray-50 @if($trans->denda > 0) bg-red-50 @endif">
                            <td class="px-6 py-3 font-medium">{{ $trans->book->judul }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($trans->tanggal_pinjam)->format('d M Y') }}</td>
                            <td class="px-6 py-3">{{ $trans->tanggal_kembali ? \Carbon\Carbon::parse($trans->tanggal_kembali)->format('d M Y') : '-' }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $trans->status === 'Dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $trans->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                @if($trans->denda > 0)
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                        Rp {{ number_format($trans->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-100 rounded-2xl p-6 border">
                <p class="text-gray-600">Belum ada riwayat transaksi.</p>
            </div>
        @endif
    </div>

    {{-- Seksi kontak (biar nyatu style-nya kayak “welcome”) --}}
    <div class="py-10 mx-2 md:mx-0 flex flex-col md:flex-row gap-10">
        <p class="text-5xl font-black w-full md:w-1/3">
            HUBUNGI KAMI
        </p>
        <div class="bg-[#242424] rounded-2xl w-full h-fit flex flex-col md:flex-row px-10 py-10 divide-y md:divide-y-0 md:divide-x divide-white text-white">
            <div class="flex-1 pb-6 md:pb-0 md:pr-6">
                <p class="font-black text-2xl mb-2">Alamat</p>
                <p>Jl. Merdeka No. 45, Malang, Jawa Timur</p>
            </div>
            <div class="flex-1 py-6 md:py-0 md:px-6">
                <p class="font-black text-2xl mb-2">Email</p>
                <p>info@kneegrowlibrary.com</p>
            </div>
            <div class="flex-1 pt-6 md:pt-0 md:pl-6">
                <p class="font-black text-2xl mb-2">Telepon</p>
                <p>+62 812-3456-7890</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
