@extends('template.layout-admin')

@section('title', 'Data Anggota')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')

<main class="pl-34 p-6 min-h-screen">
    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Anggota</h1>
        <a href="/anggotatambah" 
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Anggota
        </a>
    </div>

    <!-- SEARCH BAR -->
    <div class="bg-white p-4 rounded-xl shadow border mb-6 flex items-center justify-between">
        <input type="text" placeholder="Cari nama anggota..." 
               class="w-full border rounded-lg px-3 py-2 mr-3 focus:outline-none focus:ring focus:ring-blue-300">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Cari</button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow border overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nama Anggota</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Nomor Telepon</th>
                    <th class="px-6 py-3">Tanggal Daftar</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy Data -->
                @php
                    $anggota = [
                        ['nama' => 'Budi Santoso', 'email' => 'budi@example.com', 'telepon' => '081234567890', 'tgl' => '12 Jan 2025'],
                        ['nama' => 'Siti Aminah', 'email' => 'siti@example.com', 'telepon' => '081212345678', 'tgl' => '15 Jan 2025'],
                        ['nama' => 'Andi Pratama', 'email' => 'andi@example.com', 'telepon' => '081345678901', 'tgl' => '20 Jan 2025'],
                        ['nama' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'telepon' => '081278945612', 'tgl' => '22 Jan 2025'],
                        ['nama' => 'Rina Marlina', 'email' => 'rina@example.com', 'telepon' => '081394857293', 'tgl' => '25 Jan 2025'],
                    ];
                @endphp

                @foreach ($anggota as $i => $a)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-6 py-3">{{ $i + 1 }}</td>
                    <td class="px-6 py-3 font-medium text-gray-900">{{ $a['nama'] }}</td>
                    <td class="px-6 py-3">{{ $a['email'] }}</td>
                    <td class="px-6 py-3">{{ $a['telepon'] }}</td>
                    <td class="px-6 py-3">{{ $a['tgl'] }}</td>
                    <td class="px-6 py-3 flex justify-center gap-2">
                        <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Detail</button>
                        <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                        <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PAGINATION (Dummy) -->
    <div class="mt-6 flex justify-center">
        <nav class="flex space-x-1">
            <button class="px-3 py-1 border rounded-lg text-gray-600 hover:bg-gray-100">‹</button>
            <button class="px-3 py-1 border rounded-lg bg-blue-600 text-white">1</button>
            <button class="px-3 py-1 border rounded-lg text-gray-600 hover:bg-gray-100">2</button>
            <button class="px-3 py-1 border rounded-lg text-gray-600 hover:bg-gray-100">3</button>
            <button class="px-3 py-1 border rounded-lg text-gray-600 hover:bg-gray-100">›</button>
        </nav>
    </div>
</main>

@endsection
