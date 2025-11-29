@extends('template.layout-admin')

@section('title', 'Data Anggota')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')
<main class="pl-34 p-6 min-h-screen">

    <a href="{{ route('anggotaadmin.index') }}" 
       class="text-blue-600 hover:underline mb-4 inline-block">
        ← Kembali ke daftar anggota
    </a>

    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-3xl space-y-8">

        <div>
            <h1 class="text-3xl font-bold">{{ $anggota->name }}</h1>
            <p class="text-gray-500 mt-1">Detail informasi anggota</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div class="space-y-1">
                <p class="text-gray-500 text-sm">Nama Lengkap</p>
                <p class="text-lg font-semibold">{{ $anggota->name }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-gray-500 text-sm">Username</p>
                <p class="text-lg font-semibold">{{ $anggota->username }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-gray-500 text-sm">Email</p>
                <p class="text-lg font-semibold">{{ $anggota->email }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-gray-500 text-sm">No Telepon</p>
                <p class="text-lg font-semibold">{{ $anggota->notelp ?? '-' }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-gray-500 text-sm">Role</p>
                <p class="text-lg font-semibold capitalize">{{ $anggota->role }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-gray-500 text-sm">Tanggal Daftar</p>
                <p class="text-lg font-semibold">
                    {{ $anggota->created_at ? $anggota->created_at->format('d M Y') : '-' }}
                </p>
            </div>

        </div>

        <div class="mt-2">
            <p class="text-gray-500 text-sm">Foto Profil</p>
            @if ($anggota->profile_photo)
                <img src="{{ asset('storage/'.$anggota->profile_photo) }}" 
                     class="w-32 h-32 rounded-full object-cover mt-3 shadow">
            @else
                <p class="text-gray-600 mt-2">Tidak ada foto</p>
            @endif
        </div>

        <div class="flex gap-4 pt-4 border-t">
            <a href="{{ route('anggotaadmin.edit', $anggota->id) }}" 
               class="px-5 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                Edit
            </a>

            <form action="{{ route('anggotaadmin.destroy', $anggota->id) }}" 
                  method="POST"
                  onsubmit="return confirm('Hapus anggota ini?')">
                @csrf
                @method('DELETE')
                <button class="px-5 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    Hapus
                </button>
            </form>
        </div>

    </div>

</main>
@endsection
