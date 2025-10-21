@extends('template.layout')

@section('title', 'welcome')

    @section('header')
        @include('template.navbar')
    @endsection

    @section('main')
    
    <div class="mx-10 gap-20">
        <div class="py-20 mx-10 w-140">
            <div>
                <p class="text-6xl font-black">
                    RUANG LITERASI <span>NYAMAN</span> DAN <span>KOLABORATIF</span>
                </p>
                <p class="mt-15 ml-1">
                    Kneegrow Library adalah ruang literasi modern yang menghadirkan koleksi buku, jurnal, dan referensi digital untuk mendukung kebutuhan belajar, riset, dan hiburan. Kami berkomitmen menjadi pusat pengetahuan yang mudah diakses, nyaman, serta relevan dengan perkembangan zaman.
                </p>
                <button class="group flex items-center gap-2 mt-10 ml-1 w-fit h-fit px-3 py-2 rounded-full bg-[#242424] text-white transition-all duration-300 overflow-hidden">
                    <span>tentang kami</span>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         viewBox="0 0 24 24"
                         class="w-0 opacity-0 transition-all duration-300 group-hover:w-5 group-hover:opacity-100">
                      <path fill="currentColor" fill-rule="evenodd" 
                            d="M13.47 5.47a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4a.75.75 0 0 1 0-1.5h14.19l-4.72-4.72a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/>
                    </svg>
                </button>                                    
            </div>
        </div>
    
        <div class="py-10 mx-11">
            <div class="flex gap-10 items-center">
                <p class="text-4xl font-black">
                    koleksi buku
                </p>
                <p class="w-108 leading-4">
                    koleksi buku dengan berbagai genre dan juga terdapat jurnal pembelajaran yang dapat menambah ilmu
                </p>
            </div>
            <div class="my-10 justify-between flex">
                <div class="w-60 h-85 bg-gray-200 rounded-2xl border hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                </div> 
                <div class="w-60 h-85 bg-gray-200 rounded-2xl border hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                </div> 
                <div class="w-60 h-85 bg-gray-200 rounded-2xl border hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                </div> 
                <div class="w-60 h-85 bg-gray-200 rounded-2xl border hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                </div> 
            </div>
            <div class="flex justify-end">
                <button class="group flex items-center gap-2 mt-10 ml-1 w-fit h-fit px-3 py-2 rounded-full bg-[#242424] text-white transition-all duration-300 overflow-hidden">
                    <span>lebih banyak</span>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         viewBox="0 0 24 24"
                         class="w-0 opacity-0 transition-all duration-300 group-hover:w-5 group-hover:opacity-100">
                      <path fill="currentColor" fill-rule="evenodd" 
                            d="M13.47 5.47a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4a.75.75 0 0 1 0-1.5h14.19l-4.72-4.72a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="py-10 mx-11">
            <div class="flex gap-10 items-center">
                <p class="text-4xl font-black">
                    Layanan
                </p>
                <p class="w-108 leading-4">
                    koleksi buku dengan berbagai genre dan juga terdapat jurnal pembelajaran yang dapat menambah ilmu
                </p>
            </div>
            <div class="my-10 bg-[#242424] rounded-2xl w-full h-80 flex px-10 py-10 divide-x divide-white">
                <div class="w-1/3 text-white flex flex-col justify-between pr-6">
                    <p class="font-black text-2xl">
                        Tempat yang Nyaman
                    </p>
                    <p>
                        Perpustakaan kami dirancang sebagai ruang literasi yang tenang, modern, dan menyenangkan, sehingga setiap pengunjung dapat fokus belajar, membaca, maupun bersantai.
                    </p>
                </div>
            
                <div class="w-1/3 text-white flex flex-col justify-between px-6">
                    <p class="font-black text-2xl">
                        Komunitas yang Saling Mendukung
                    </p>
                    <p>
                        Lebih dari sekadar membaca, perpustakaan ini juga menjadi wadah bagi komunitas untuk bertemu, berbagi ide, dan saling menginspirasi dalam suasana yang sehat dan positif.
                    </p>
                </div>
            
                <div class="w-1/3 text-white flex flex-col justify-between pl-6">
                    <p class="font-black text-2xl">
                        Sesi Pembahasan Sastra
                    </p>
                    <p>
                        Kami menghadirkan koleksi buku sastra pilihan disertai forum pembahasan rutin, di mana pembaca dapat berdiskusi dan menikmati pengalaman literasi yang lebih mendalam.
                    </p>
                </div>
            </div>
        </div>

        <div class="py-10 mx-11 flex gap-20">
            <p class="text-7xl font-black w-70">
                LET'S GET IN TOUCH
            </p>
            <div class="bg-[#242424] rounded-2xl w-full h-50 flex px-10 py-10 divide-x divide-white text-white">
                <div class="w-1/3 pr-6">
                    <p class="font-black text-2xl mb-2">Alamat</p>
                    <p>Jl. Merdeka No. 45, Malang, Jawa Timur</p>
                </div>
                <div class="w-1/3 px-6">
                    <p class="font-black text-2xl mb-2">Email</p>
                    <p>info@kneegrowlibrary.com</p>
                </div>
                <div class="w-1/3 pl-6">
                    <p class="font-black text-2xl mb-2">Telepon</p>
                    <p>+62 812-3456-7890</p>
                </div>
            </div>
        </div>
    </div> 

    @section('footer')
        @include('template.footer')
    @endsection


@endsection