@extends('template.layout')

@section('title', 'Contact Us')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 gap-20">

    <!-- Hero Section -->
    <div class="py-20 mx-10 w-140">
        <div>
            <p class="text-6xl font-black">
                HUBUNGI <span>KAMI</span>
            </p>
            <p class="mt-10 ml-1">
                Kami senang mendengar dari Anda! Jika Anda memiliki pertanyaan, saran, atau ingin berkolaborasi dengan Kneegrow Library, jangan ragu untuk menghubungi kami melalui formulir atau informasi kontak di bawah ini.
            </p>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="py-10 mx-11">
        <div class="flex gap-10 items-center">
            <p class="text-4xl font-black">
                Informasi Kontak
            </p>
            <p class="w-108 leading-4">
                Anda dapat menghubungi kami melalui email, nomor telepon, atau datang langsung ke lokasi perpustakaan kami.
            </p>
        </div>
        <div class="my-10 bg-[#242424] rounded-2xl w-full h-fit flex px-10 py-10 divide-x divide-white text-white">
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

    <!-- Contact Form Section -->
    <div class="py-10 mx-11 flex gap-20">
        <p class="text-7xl font-black w-70">
            KIRIM PESANMU
        </p>

        <div class="ml-5 h-fit w-full rounded-2xl bg-[#242424] p-8 text-white">
            <form action="" method="POST" class="flex flex-col gap-5">
                @csrf
                <div>
                    <label class="block mb-2 text-sm font-semibold">Nama</label>
                    <input type="text" name="name" required class="border-b-1 border-white w-full p-3 text-black outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold">Email</label>
                    <input type="email" name="email" required class="border-b-1 border-white w-full p-3 text-black outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold">Pesan</label>
                    <textarea name="message" rows="5" required class="border-b-1 border-white w-full p-3 text-black outline-none"></textarea>
                </div>

                <button type="submit" class="group flex items-center gap-2 mt-3 w-fit h-fit px-4 py-2 rounded-full bg-white text-black transition-all duration-300 overflow-hidden hover:bg-gray-300">
                    <span>Kirim Pesan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         viewBox="0 0 24 24"
                         class="w-0 opacity-0 transition-all duration-300 group-hover:w-5 group-hover:opacity-100">
                      <path fill="currentColor" fill-rule="evenodd" 
                            d="M13.47 5.47a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4a.75.75 0 0 1 0-1.5h14.19l-4.72-4.72a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

</div>

@section('footer')
    @include('template.footer')
@endsection

@endsection
