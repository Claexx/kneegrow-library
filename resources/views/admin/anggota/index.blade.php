@extends('template.layout-admin')

@section('title', 'Data Anggota')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Anggota</h1>
        <a href="{{ route('anggotaadmin.create') }}" 
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Anggota
        </a>
    </div>

    <div class="bg-white rounded-xl shadow border overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nama Anggota</th>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">No Telepon</th>
                    <th class="px-6 py-3">Tanggal Daftar</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $i => $a)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-6 py-3">{{ $i + 1 }}</td>
                    <td class="px-6 py-3 font-medium text-gray-900">{{ $a->name }}</td>
                    <td class="px-6 py-3 font-medium text-gray-900">{{ $a->username }}</td>
                    <td class="px-6 py-3">{{ $a->email }}</td>
                    <td class="px-6 py-3">{{ $a->notelp ?? '-' }}</td>
                    <td class="px-6 py-3">
                        {{ $a->created_at ? $a->created_at->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-3 flex justify-center gap-2">
                        <a href="{{ route('anggotaadmin.show', $a->id) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Detail</a>
                        <a href="{{ route('anggotaadmin.edit', $a->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('anggotaadmin.destroy', $a->id) }}" method="POST"
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
</main>

@endsection
