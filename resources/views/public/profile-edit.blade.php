@extends('template.layout')

@section('title', 'Edit Profil')

@section('header')
    @include('template.navbar')
@endsection

@section('main')
<div class="container section mx-auto px-4 py-10">
    <div class="mb-8">
        <a href="{{ route('profile') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Kembali ke Profil</a>
        <h1 class="text-4xl md:text-6xl font-black uppercase">Edit Profil</h1>
        <p class="mt-2 text-gray-600">Perbarui informasi akun Anda</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 border border-gray-200 max-w-4xl">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Alert Messages --}}
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-10">
                {{-- Kolom Kiri: Foto Profil --}}
                <div class="flex flex-col items-center space-y-4">
                    <div id="photo-preview-container" class="relative group">
                        @php
                            $colors = ['bg-blue-600', 'bg-green-600', 'bg-yellow-500', 'bg-red-600', 'bg-purple-600', 'bg-pink-600'];
                            $color = $colors[crc32(Auth::user()->username) % count($colors)];
                        @endphp
                        
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                                 id="photo-preview-img"
                                 class="w-40 h-40 rounded-full object-cover border-4 border-gray-800 shadow-lg" 
                                 alt="Foto Profil">
                        @else
                            <div id="photo-placeholder" class="w-40 h-40 rounded-full flex items-center justify-center text-white text-6xl font-black {{ $color }} border-4 border-gray-800 shadow-lg">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                            {{-- Placeholder untuk img saat preview dipilih --}}
                            <img id="photo-preview-img" class="w-40 h-40 rounded-full object-cover border-4 border-gray-800 shadow-lg hidden">
                        @endif
                    </div>
                    
                    <label class="cursor-pointer">
                        <span class="px-6 py-2 bg-gray-800 text-white rounded-full font-medium hover:bg-black transition block text-center">
                            Pilih Foto
                        </span>
                        <input type="file" name="profile_photo" accept="image/*" class="hidden" id="profile-photo-input">
                    </label>
                    <p class="text-gray-500 text-xs">Max 2MB (JPG, PNG)</p>
                </div>

                {{-- Kolom Kanan: Input Data --}}
                <div class="flex-1 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Username</label>
                            <input type="text" value="{{ Auth::user()->username }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nomor Telepon</label>
                        <input type="text" name="notelp" value="{{ old('notelp', Auth::user()->notelp) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 outline-none" required>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <p class="font-bold text-gray-800 mb-4">Ubah Password <span class="text-sm font-normal text-gray-500">(Opsional)</span></p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Password Baru</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 outline-none">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-6">
                        <button type="submit" class="flex-1 px-6 py-3 bg-gray-800 text-white rounded-xl font-bold hover:bg-black transition shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('profile-photo-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgPreview = document.getElementById('photo-preview-img');
                const placeholder = document.getElementById('photo-placeholder');
                
                imgPreview.src = event.target.result;
                imgPreview.classList.remove('hidden');
                
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection