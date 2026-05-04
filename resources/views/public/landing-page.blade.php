@extends('template.layout')

@section('title', 'welcome')

    @section('header')
        @include('template.navbar')
    @endsection

    @section('main')
    
    @if ($errors->has('akses'))
    <div class="mx-4 sm:mx-6 lg:mx-10 mt-5">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
            <strong class="font-bold">Akses Ditolak!</strong>
            <span class="block sm:inline">{{ $errors->first('akses') }}</span>
        </div>
    </div>
    @endif
    
    <div class="mx-4 sm:mx-6 lg:mx-10 gap-20">
        <!-- Hero Section -->
        <div class="py-10 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-40 items-center">
                <div class="w-full lg:w-140">
                    <p class="text-3xl sm:text-4xl lg:text-6xl font-black leading-tight">
                        RUANG LITERASI <span class="text-[#87FF79]">NYAMAN</span> DAN <span class="text-[#87FF79]">KOLABORATIF</span>
                    </p>
                    <p class="mt-6 sm:mt-8 lg:mt-15 text-sm sm:text-base leading-relaxed text-gray-700">
                        Kneegrow Library adalah ruang literasi modern yang menghadirkan koleksi buku, jurnal, dan referensi digital untuk mendukung kebutuhan belajar, riset, dan hiburan. Kami berkomitmen menjadi pusat pengetahuan yang mudah diakses, nyaman, serta relevan dengan perkembangan zaman.
                    </p>
                    <a class="group inline-flex items-center gap-2 mt-8 lg:mt-10 px-6 py-3 rounded-full bg-[#535353] text-white transition-all duration-300 overflow-hidden hover:shadow-lg" href="/about">
                        <span class="text-sm sm:text-base">tentang kami</span>
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             viewBox="0 0 24 24"
                             class="w-0 opacity-0 transition-all duration-300 group-hover:w-5 group-hover:opacity-100">
                          <path fill="currentColor" fill-rule="evenodd" 
                                d="M13.47 5.47a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4a.75.75 0 0 1 0-1.5h14.19l-4.72-4.72a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/>
                        </svg>
                    </a>                                    
                </div>
                <div class="w-full sm:w-80 lg:w-100">
                    <img src="{{ asset('cover.png') }}" alt="Kneegrow Library" class="w-full h-auto rounded-lg">
                </div>
            </div>
        </div>
        
        <!-- Koleksi Buku Section -->
        <div class="py-10 sm:py-16 px-4 sm:px-6 lg:px-11">
            <div class="flex flex-col gap-4 sm:gap-10 mb-8">
                <h2 class="text-3xl sm:text-4xl lg:text-4xl font-black">
                    koleksi buku
                </h2>
                <p class="max-w-2xl text-sm sm:text-base text-gray-700 leading-relaxed">
                    koleksi buku dengan berbagai genre dan juga terdapat jurnal pembelajaran yang dapat menambah ilmu
                </p>
            </div>

            <!-- Category Tabs -->
            <div class="flex flex-wrap gap-2 sm:gap-3 mb-8 overflow-x-auto pb-2">
                <button class="category-filter px-4 sm:px-6 py-2 rounded-full bg-[#535353] text-white text-sm sm:text-base font-semibold whitespace-nowrap transition hover:shadow-lg" data-category="all">
                    Semua Kategori
                </button>
                <button class="category-filter px-4 sm:px-6 py-2 rounded-full border-2 border-[#535353] text-[#535353] text-sm sm:text-base font-semibold whitespace-nowrap transition hover:bg-gray-100" data-category="fiksi">
                    Fiksi
                </button>
                <button class="category-filter px-4 sm:px-6 py-2 rounded-full border-2 border-[#535353] text-[#535353] text-sm sm:text-base font-semibold whitespace-nowrap transition hover:bg-gray-100" data-category="non-fiksi">
                    Non-Fiksi
                </button>
                <button class="category-filter px-4 sm:px-6 py-2 rounded-full border-2 border-[#535353] text-[#535353] text-sm sm:text-base font-semibold whitespace-nowrap transition hover:bg-gray-100" data-category="akademik">
                    Akademik
                </button>
                <button class="category-filter px-4 sm:px-6 py-2 rounded-full border-2 border-[#535353] text-[#535353] text-sm sm:text-base font-semibold whitespace-nowrap transition hover:bg-gray-100" data-category="referensi">
                    Referensi
                </button>
            </div>

            <!-- Books Grid -->
            <div class="my-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8 justify-items-center">
                    @foreach ($books->take(8) as $book)
                        <div class="book-card w-full sm:w-60 bg-white rounded-2xl border border-gray-200
                                    hover:shadow-[0px_10px_20px_0px_rgba(36,36,36,0.15)] 
                                    hover:-translate-y-2 transition duration-300 ease-in-out overflow-hidden cursor-pointer"
                             data-category="{{ strtolower($book->kategori ?? 'umum') }}">
            
                            <div class="relative overflow-hidden h-72 bg-gray-200">
                                <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}"
                                     alt="{{ $book->judul }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute top-3 right-3 bg-[#87FF79] text-[#535353] px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">
                                    {{ $book->kategori ?? 'Umum' }}
                                </div>
                            </div>
            
                            <div class="p-4 sm:p-5 text-center">
                                <h2 class="text-black font-semibold text-sm sm:text-base line-clamp-2 mb-2">{{ $book->judul }}</h2>
                                <p class="text-gray-600 text-xs sm:text-sm mb-4 line-clamp-1">oleh {{ $book->penulis }}</p>
                                
                                <div class="flex gap-2 flex-col sm:flex-row">
                                    <a href="{{ route('buku.showlp', $book->id) }}"
                                       class="w-full bg-white border-2 border-[#535353] text-[#535353] text-xs sm:text-sm px-3 py-2 rounded-full hover:bg-[#535353] hover:text-white transition font-semibold">
                                        Detail
                                    </a>
            
                                    <form action="/book/{{ $book->id }}/borrow" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="bg-[#87FF79] text-[#535353] text-xs sm:text-sm px-3 py-2 rounded-full hover:bg-[#87FF79] transition w-full font-semibold">
                                            Pinjam
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($books->hasPages())
                    <div class="flex justify-center mt-10">
                        {{ $books->links() }}
                    </div>
                @endif                 
            </div>

            <div class="flex justify-center">
                <a href="/books" class="group inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#535353] text-white transition-all duration-300 overflow-hidden hover:shadow-lg font-semibold">
                    <span>lebih banyak buku</span>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         viewBox="0 0 24 24"
                         class="w-0 opacity-0 transition-all duration-300 group-hover:w-5 group-hover:opacity-100">
                      <path fill="currentColor" fill-rule="evenodd" 
                            d="M13.47 5.47a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4a.75.75 0 0 1 0-1.5h14.19l-4.72-4.72a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Layanan Section -->
        <div class="py-10 sm:py-16 px-4 sm:px-6 lg:px-11">
            <div class="flex flex-col gap-4 sm:gap-10 mb-8">
                <h2 class="text-3xl sm:text-4xl font-black">
                    Layanan
                </h2>
                <p class="max-w-2xl text-sm sm:text-base text-gray-700 leading-relaxed">
                    koleksi buku dengan berbagai genre dan juga terdapat jurnal pembelajaran yang dapat menambah ilmu
                </p>
            </div>

            <div class="my-10 bg-[#535353] rounded-2xl w-full px-4 sm:px-6 lg:px-10 py-8 sm:py-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    <div class="text-white flex flex-col justify-between">
                        <p class="font-black text-xl sm:text-2xl mb-4">
                            Tempat yang Nyaman
                        </p>
                        <p class="text-sm sm:text-base leading-relaxed">
                            Perpustakaan kami dirancang sebagai ruang literasi yang tenang, modern, dan menyenangkan, sehingga setiap pengunjung dapat fokus belajar, membaca, maupun bersantai.
                        </p>
                    </div>
                
                    <div class="text-white flex flex-col justify-between border-t md:border-t-0 md:border-l border-gray-600 pt-6 md:pt-0 md:pl-6">
                        <p class="font-black text-xl sm:text-2xl mb-4">
                            Komunitas yang Saling Mendukung
                        </p>
                        <p class="text-sm sm:text-base leading-relaxed">
                            Lebih dari sekadar membaca, perpustakaan ini juga menjadi wadah bagi komunitas untuk bertemu, berbagi ide, dan saling menginspirasi dalam suasana yang sehat dan positif.
                        </p>
                    </div>
                
                    <div class="text-white flex flex-col justify-between border-t md:border-t-0 md:border-l border-gray-600 pt-6 md:pt-0 md:pl-6">
                        <p class="font-black text-xl sm:text-2xl mb-4">
                            Sesi Pembahasan Sastra
                        </p>
                        <p class="text-sm sm:text-base leading-relaxed">
                            Kami menghadirkan koleksi buku sastra pilihan disertai forum pembahasan rutin, di mana pembaca dapat berdiskusi dan menikmati pengalaman literasi yang lebih mendalam.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="py-10 sm:py-16 px-4 sm:px-6 lg:px-11 flex flex-col lg:flex-row gap-8 lg:gap-20">
            <div class="flex-shrink-0">
                <p class="text-4xl sm:text-5xl lg:text-7xl font-black leading-tight">
                    LET'S<br/>GET IN<br/>TOUCH
                </p>
            </div>
            
            <div class="bg-[#535353] rounded-2xl w-full px-4 sm:px-6 lg:px-10 py-8 sm:py-10 flex-grow">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 text-white">
                    <div class="border-b sm:border-b-0 sm:border-r border-gray-600 pb-6 sm:pb-0 sm:pr-6">
                        <p class="font-black text-lg sm:text-2xl mb-3">Alamat</p>
                        <p class="text-sm sm:text-base">Jl. Merdeka No. 45, Malang, Jawa Timur</p>
                    </div>
                    <div class="border-b sm:border-b-0 sm:border-r border-gray-600 pb-6 sm:pb-0 sm:px-6">
                        <p class="font-black text-lg sm:text-2xl mb-3">Email</p>
                        <p class="text-sm sm:text-base break-words">info@kneegrowlibrary.com</p>
                    </div>
                    <div class="border-b sm:border-b-0 pb-6 sm:pb-0 sm:pl-6">
                        <p class="font-black text-lg sm:text-2xl mb-3">Telepon</p>
                        <p class="text-sm sm:text-base">+62 812-3456-7890</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    @section('footer')
        @include('template.footer')
    @endsection


@endsection