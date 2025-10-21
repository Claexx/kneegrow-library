@extends('template.layout')

@section('title', 'Services')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 gap-20">

    <!-- Hero Section -->
    <div class="py-20 mx-10 w-140">
        <div>
            <p class="text-6xl font-black">
                LAYANAN <span>KAMI</span>
            </p>
            <p class="mt-10 ml-1">
                Kneegrow Library menyediakan berbagai layanan literasi dan pembelajaran untuk mendukung kebutuhan akademik, riset, maupun hiburan pembaca. Semua layanan kami dirancang agar mudah diakses dan inklusif bagi semua kalangan.
            </p>
        </div>
    </div>

    <!-- Service Cards -->
    <div class="py-10 mx-11">
        <div class="flex gap-10 items-center">
            <p class="text-4xl font-black">Apa yang Kami Tawarkan</p>
            <p class="w-108 leading-4">
                Beragam layanan yang dapat membantu Anda mengeksplorasi ilmu pengetahuan dan mengembangkan kreativitas.
            </p>
        </div>

        <div class="my-10 flex justify-between">
            <div class="w-60 h-85 bg-gray-200 rounded-2xl border p-6 flex flex-col justify-between hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <p class="font-black text-xl mb-2">Peminjaman Buku</p>
                <p class="text-sm">Nikmati akses ke ratusan buku dari berbagai kategori, dari fiksi hingga akademik.</p>
            </div>

            <div class="w-60 h-85 bg-gray-200 rounded-2xl border p-6 flex flex-col justify-between hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <p class="font-black text-xl mb-2">Akses Digital</p>
                <p class="text-sm">Unduh jurnal, e-book, dan referensi online melalui sistem perpustakaan digital kami.</p>
            </div>

            <div class="w-60 h-85 bg-gray-200 rounded-2xl border p-6 flex flex-col justify-between hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <p class="font-black text-xl mb-2">Ruang Diskusi</p>
                <p class="text-sm">Fasilitas ruang nyaman untuk belajar kelompok, berdiskusi, dan brainstorming ide.</p>
            </div>

            <div class="w-60 h-85 bg-gray-200 rounded-2xl border p-6 flex flex-col justify-between hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <p class="font-black text-xl mb-2">Acara Literasi</p>
                <p class="text-sm">Ikuti berbagai acara seperti bedah buku, pelatihan menulis, dan diskusi sastra rutin.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-10 mx-11 flex flex-col lg:flex-row gap-10 lg:gap-20 items-center">
        <!-- Judul besar -->
        <p class="text-5xl lg:text-5xl font-black w-full lg:w-2/5 leading-tight text-center lg:text-left">
            INGIN BERKOLABORASI?
        </p>
    
        <!-- Kotak isi dan tombol -->
        <div class="w-full lg:w-3/5 rounded-2xl bg-[#242424] text-white p-10 flex flex-col justify-between">
            <p class="text-base lg:text-lg mb-6 leading-relaxed">
                Kami terbuka untuk kerja sama dan kolaborasi dengan sekolah, komunitas, maupun individu 
                yang memiliki semangat dalam pengembangan literasi.
            </p>
    
            <a href="{{ route('contact') }}" 
               class="group flex items-center gap-2 w-fit h-fit px-5 py-3 rounded-full bg-white text-black transition-all duration-300 overflow-hidden hover:bg-gray-300">
                <span class="font-semibold">Hubungi Kami</span>
                <svg xmlns="http://www.w3.org/2000/svg" 
                     viewBox="0 0 24 24"
                     class="w-0 opacity-0 transition-all duration-300 group-hover:w-5 group-hover:opacity-100">
                    <path fill="currentColor" fill-rule="evenodd" 
                          d="M13.47 5.47a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4a.75.75 0 0 1 0-1.5h14.19l-4.72-4.72a.75.75 0 0 1 0-1.06" 
                          clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
    

</div>

@section('footer')
    @include('template.footer')
@endsection

@endsection
