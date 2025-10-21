@extends('template.layout')

@section('title', 'About Us')

@section('header')
    @include('template.navbar')
@endsection

@section('main')

<div class="mx-10 gap-20">

    <!-- Hero Section -->
    <div class="py-20 mx-10 w-140">
        <div>
            <p class="text-6xl font-black">
                TENTANG <span>KAMI</span>
            </p>
            <p class="mt-10 ml-1">
                Kneegrow Library merupakan ruang literasi yang didirikan untuk menghadirkan pengalaman membaca dan belajar yang nyaman, modern, dan kolaboratif. Kami percaya bahwa pengetahuan adalah kunci untuk menciptakan perubahan positif bagi masyarakat.
            </p>
        </div>
    </div>

    <!-- Vision & Mission Section -->
    <div class="py-10 mx-11">
        <div class="flex gap-10 items-center">
            <p class="text-4xl font-black">Visi & Misi</p>
            <p class="w-108 leading-4">
                Menjadi pusat literasi yang terbuka bagi semua kalangan, serta mendorong semangat membaca dan berpikir kritis melalui fasilitas dan program yang inovatif.
            </p>
        </div>

        <div class="my-10 bg-[#242424] rounded-2xl w-full h-fit flex px-10 py-10 divide-x divide-white text-white">
            <div class="w-1/3 pr-6">
                <p class="font-black text-2xl mb-2">Visi</p>
                <p>
                    Menjadi ruang literasi unggulan yang menginspirasi generasi muda untuk terus belajar dan berbagi ilmu dalam suasana yang positif dan kolaboratif.
                </p>
            </div>
            <div class="w-2/3 pl-6">
                <p class="font-black text-2xl mb-2">Misi</p>
                <ul class="list-disc pl-6">
                    <li>Meningkatkan akses terhadap literatur berkualitas.</li>
                    <li>Membangun komunitas pembaca aktif dan kreatif.</li>
                    <li>Menyediakan ruang belajar yang nyaman dan inklusif.</li>
                    <li>Mendukung kegiatan literasi dan diskusi publik secara rutin.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="py-10 mx-11">
        <div class="flex gap-10 items-center">
            <p class="text-4xl font-black">Tim Kami</p>
            <p class="w-108 leading-4">
                Di balik Kneegrow Library, terdapat tim yang berdedikasi untuk mengembangkan ruang literasi yang terus berkembang dan berorientasi pada komunitas.
            </p>
        </div>

        <div class="my-10 flex justify-between">
            <div class="w-60 h-80 bg-gray-200 rounded-2xl border flex flex-col items-center justify-center hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <div class="w-24 h-24 bg-gray-400 rounded-full mb-4"></div>
                <p class="font-semibold">Rina Kusuma</p>
                <p class="text-sm text-gray-500">Kepala Perpustakaan</p>
            </div>

            <div class="w-60 h-80 bg-gray-200 rounded-2xl border flex flex-col items-center justify-center hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <div class="w-24 h-24 bg-gray-400 rounded-full mb-4"></div>
                <p class="font-semibold">Bima Ardi</p>
                <p class="text-sm text-gray-500">Koordinator Acara</p>
            </div>

            <div class="w-60 h-80 bg-gray-200 rounded-2xl border flex flex-col items-center justify-center hover:shadow-[0px_15px_0px_0px_rgba(36,36,36,1)] hover:translate-y-[-2px] transition duration-300 ease-in-out">
                <div class="w-24 h-24 bg-gray-400 rounded-full mb-4"></div>
                <p class="font-semibold">Sinta Dewi</p>
                <p class="text-sm text-gray-500">Humas & Media</p>
            </div>
        </div>
    </div>

</div>

@section('footer')
    @include('template.footer')
@endsection

@endsection
