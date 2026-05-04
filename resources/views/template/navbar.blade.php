<nav class="sticky top-0 bg-white items-center z-50 border-b-2 border-gray-200 shadow-sm w-full">
    <div class="container py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex-shrink-0">
            <img src="{{ asset('logo.svg') }}" alt="Logo Kneegrow Library" class="w-10 sm:w-12 h-auto transition hover:opacity-80 responsive">
        </a>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn" class="lg:hidden flex items-center text-[#242424] hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex gap-8 items-center flex-1 justify-center px-10">
            <a href="/" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">home</a>
            <a href="/about" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">about</a>
            <a href="/books" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">book</a>
            @auth
                <a href="{{ route('activity.index') }}" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">
                    activity
                </a>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">
                    activity
                </a>
            @endauth
            <a href="/service" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">service</a>
            <a href="/contact" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm">contact us</a>
            @if(auth()->user()?->is_admin)
                <a href="/dashboardadmin" class="text-red-600 hover:text-red-700 transition font-medium text-sm">🔐 admin</a>
            @endif
        </div>

        <!-- Profile/Auth Section -->
        <div class="flex-shrink-0">
            @auth
                @php
                    $colors = ['bg-blue-600', 'bg-green-600', 'bg-yellow-500', 'bg-red-600', 'bg-purple-600', 'bg-pink-600'];
                    $color = $colors[crc32(Auth::user()->username) % count($colors)];
                @endphp

                <button id="profileDropdownButton" class="focus:outline-none group relative">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                            alt="Profile"
                            class="w-10 h-10 rounded-full border-2 border-[#86FF79] object-cover transition group-hover:border-[#242424]">
                    @else
                        <div class="w-10 h-10 rounded-full {{ $color }} text-white flex items-center justify-center font-bold text-sm transition group-hover:shadow-lg">
                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                        </div>
                    @endif
                </button>

                <div id="profileDropdown"
                     class="hidden absolute right-4 mt-2 w-56 bg-white border-2 border-gray-200 rounded-2xl shadow-xl z-50">
                    <div class="p-4 border-b-2 border-gray-200">
                        <p class="font-bold text-gray-900">{{ Auth::user()->name ?? Auth::user()->username }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1 break-words">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="flex flex-col p-2">
                        <a href="/profile" class="px-4 py-3 rounded-lg hover:bg-gray-100 text-left text-sm font-medium transition">👤 Profil Saya</a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 font-medium text-sm transition">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Guest Navigation --}}
                <div class="flex gap-2 sm:gap-3">
                    <a href="{{ route('signup') }}" class="hidden sm:block">
                        <button class="rounded-full bg-white border-2 border-[#242424] text-[#242424] text-sm font-semibold px-4 sm:px-5 py-2 hover:bg-[#242424] hover:text-white transition">
                            Sign Up
                        </button>
                    </a>
                    <a href="{{ route('login') }}">
                        <button class="rounded-full bg-[#242424] text-white text-sm font-semibold px-4 sm:px-5 py-2 hover:bg-gray-800 transition">
                            Login
                        </button>
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" class="hidden lg:hidden border-t-2 border-gray-200 bg-white w-full">
        <div class="container py-4 flex flex-col gap-3">
            <a href="/" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">home</a>
            <a href="/about" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">about</a>
            <a href="/books" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">book</a>
            <a href="/activity" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">activity</a>
            <a href="/service" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">service</a>
            <a href="/contact" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">contact us</a>
            @if(auth()->user()?->is_admin)
                <a href="/dashboardadmin" class="text-red-600 hover:text-red-700 transition font-medium text-sm py-2">🔐 admin</a>
            @endif
            @guest
                <hr class="my-2">
                <a href="{{ route('signup') }}" class="text-gray-700 hover:text-[#86FF79] transition font-medium text-sm py-2">Sign Up</a>
            @endguest
        </div>
    </div>
</nav>

{{-- Script untuk toggle dropdown dan mobile menu --}}
<script>
    // Profile Dropdown
    const profileBtn = document.getElementById('profileDropdownButton');
    const profileMenu = document.getElementById('profileDropdown');

    if (profileBtn) {
        profileBtn.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !profileMenu?.contains(e.target)) {
                profileMenu?.classList.add('hidden');
            }
        });
    }

    // Mobile Menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when a link is clicked
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
</script>
