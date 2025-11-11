@extends('template.layout')

@section('title', 'Profil Saya')

@section('header')
    @include('template.navbar')
@endsection

@section('main')
<div class="mx-10 my-10">
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
                        <p class="text-gray-500 text-sm">Tanggal Bergabung</p>
                        <p class="font-semibold text-lg">{{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="#" class="w-full sm:w-fit px-6 py-2 bg-[#242424] text-white rounded-full font-medium hover:bg-[#3b3b3b] transition-all duration-200">
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
        <p class="text-3xl font-black mb-6">Aktivitas Terbaru</p>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1 bg-gray-100 rounded-2xl p-6 border hover:shadow-[0px_10px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <p class="font-bold text-xl mb-2">Buku yang Dipinjam</p>
                <p class="text-gray-600">Kamu belum meminjam buku apa pun saat ini.</p>
            </div>
            <div class="flex-1 bg-gray-100 rounded-2xl p-6 border hover:shadow-[0px_10px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <p class="font-bold text-xl mb-2">Ulasan Terbaru</p>
                <p class="text-gray-600">Belum ada ulasan yang kamu buat.</p>
            </div>
        </div>
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
