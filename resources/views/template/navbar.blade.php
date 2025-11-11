<nav class="flex mx-10 py-2 justify-between sticky top-0 bg-white items-center z-50 border-b">
    <p class="font-bold text-xl">LOGO</p>

    {{-- Navigasi utama --}}
    <div class="flex gap-7">
        <a href="/">home</a>
        <a href="/about">about</a>
        <a href="/books">book</a>
        <a href="/service">service</a>
        <a href="/contact">contact us</a>
    </div>

    {{-- Bagian kanan: login / profil --}}
    <div class="relative">
        @auth
            @php
                $colors = ['bg-blue-600', 'bg-green-600', 'bg-yellow-500', 'bg-red-600', 'bg-purple-600', 'bg-pink-600'];
                $color = $colors[crc32(Auth::user()->username) % count($colors)];
            @endphp

            {{-- Tombol foto profil / avatar --}}
            <button id="profileDropdownButton" class="focus:outline-none">
                @if (Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                        alt="Profile"
                        class="w-10 h-10 rounded-full border border-gray-300 object-cover">
                @else
                    <div class="w-10 h-10 rounded-full {{ $color }} text-white flex items-center justify-center font-semibold">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>
                @endif
            </button>

            {{-- Dropdown --}}
            <div id="profileDropdown"
                 class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-xl shadow-lg">
                <div class="p-3 border-b">
                    <p class="font-semibold">{{ Auth::user()->name ?? Auth::user()->username }}</p>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                </div>

                <div class="flex flex-col p-2">
                    <a href="/profile" class="px-3 py-2 rounded-lg hover:bg-gray-100 text-left">Profil</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-3 py-2 rounded-lg text-red-500 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            {{-- Kalau belum login --}}
            <div class="gap-3">
                <a href="{{ route('signup') }}">
                    <button class="rounded-full w-fit bg-[#242424] text-white px-3 py-1">sign up</button>
                </a>
                <a href="{{ route('login') }}">
                    <button class="rounded-full w-fit bg-[#242424] text-white px-3 py-1">login</button>
                </a>
            </div>
        @endauth
    </div>
</nav>

{{-- Script kecil untuk toggle dropdown --}}
<script>
    const btn = document.getElementById('profileDropdownButton');
    const menu = document.getElementById('profileDropdown');

    if (btn) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Klik di luar menu → tutup
        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    }
</script>
