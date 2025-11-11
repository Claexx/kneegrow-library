<div class="pl-64">
  <header class="sticky top-0 z-30 flex h-16 items-center gap-4 px-6">
    <div class="flex flex-1 items-center gap-4">
    </div>
    <div class="flex items-center gap-4">
      <!-- NOTIFIKASI HEADER -->
      <button class="relative rounded-full p-3 text-muted-foreground hover:text-foreground bg-white border shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="18" height="18" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 17h5l-5 5v-5zM9 7H4l5-5v5zm6 10V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2z"/>
        </svg>
        <span class="absolute -top-1 -right-1 h-3 w-3 rounded-full bg-secondary"></span>
      </button>

      <!-- USER AVATAR + DROPDOWN -->
      <div x-data="{ open: false }" class="relative">
        @php
            $colors = ['bg-blue-600', 'bg-green-600', 'bg-yellow-500', 'bg-red-600', 'bg-purple-600', 'bg-pink-600'];
            $color = $colors[crc32(Auth::user()->username) % count($colors)];
        @endphp

        <!-- Avatar Button -->
        <button @click="open = !open"
                class="relative rounded-full bg-white border shadow-md flex items-center justify-center focus:outline-none">
            @if (Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                    alt="Profile"
                    class="w-10 h-10 rounded-full object-cover">
            @else
                <div class="w-10 h-10 rounded-full {{ $color }} text-white flex items-center justify-center font-semibold">
                    {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                </div>
            @endif
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open"
            @click.away="open = false"
            x-transition
            class="absolute right-0 mt-2 w-56 bg-white border rounded-xl shadow-lg z-50">
            <div class="p-4 border-b">
                <p class="font-semibold">{{ Auth::user()->name ?? Auth::user()->username }}</p>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            </div>

            <div class="p-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-lg text-red-500 hover:bg-red-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
      </div>

      <!-- AlpineJS (biar bisa toggle dropdown) -->
      <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    </div>
  </header>
</div>

<aside class="fixed left-0 top-0 z-40 h-screen w-64 bg-sidebar bg-background">
  <div class="flex h-full flex-col">
    <div class="flex h-16 items-center px-6">
      <div class="flex items-center gap-2">
        <div class="h-8 w-8 ml-2 rounded-lg bg-sidebar-primary flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 19v-6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2zm0 0V9a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v10m-6 0a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2m0 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2z"/>
          </svg>
        </div>
      </div>
    </div>

    <nav class="flex-1 space-y-1 px-3 py-4 ml-2 text-[#0F0E0E]">
      <div class="h-fit w-fit bg-white rounded-full py-2 px-2 border shadow-md">
        <!-- HOME -->
        <a href="/dashboardadmin"
           class="flex items-center gap-3 w-fit h-fit rounded-full bg-sidebar-primary px-3 py-3 text-sidebar-primary-foreground hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9.5L12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-5H9v5H4a1 1 0 0 1-1-1V9.5z"/>
          </svg>
        </a>

        <!-- KOLEKSI -->
        <a href="/bukuadmin"
           class="flex items-center gap-3 w-fit h-fit rounded-full bg-sidebar-primary px-3 py-3 text-sidebar-primary-foreground hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="7" height="16" rx="2"/>
            <rect x="14" y="4" width="7" height="16" rx="2"/>
          </svg>
        </a>

        <!-- ANGGOTA -->
        <a href="/anggotaadmin"
           class="flex items-center gap-3 w-fit h-fit rounded-full bg-sidebar-primary px-3 py-3 text-sidebar-primary-foreground hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="8" cy="7" r="4"/>
            <circle cx="17" cy="7" r="4"/>
            <path d="M2 21v-2a5 5 0 0 1 5-5h3"/>
            <path d="M22 21v-2a5 5 0 0 0-5-5h-3"/>
          </svg>
        </a>

        <!-- TRANSAKSI -->
        <a href="/transaksiadmin"
           class="flex items-center gap-3 w-fit h-fit rounded-full bg-sidebar-primary px-3 py-3 text-sidebar-primary-foreground hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="6" width="20" height="12" rx="2" ry="2"/>
            <circle cx="12" cy="12" r="3"/>
            <path d="M6 12h.01"/>
            <path d="M18 12h.01"/>
          </svg>
        </a>
      </div>

      <!-- BAGIAN BAWAH -->
      <div class="h-fit w-fit bg-white rounded-full py-2 px-2 mt-2 border shadow-md">
        <!-- NOTIFIKASI -->
        <a href="/notifikasiadmin"
           class="flex items-center gap-3 w-fit h-fit rounded-full bg-sidebar-primary px-3 py-3 text-sidebar-primary-foreground hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M15.019 17h-6.04m6.04 0h3.614c1.876 0 1.559-1.86.61-2.804C15.825 10.801 20.68 3 11.999 3s-3.825 7.8-7.243 11.196c-.913.908-1.302 2.804.61 2.804H8.98m6.039 0c0 1.925-.648 4-3.02 4s-3.02-2.075-3.02-4"/>
          </svg>
        </a>

        <!-- PENGATURAN -->
        <a href="/pengaturanadmin"
           class="flex items-center gap-3 w-fit h-fit rounded-full bg-sidebar-primary px-3 py-3 text-sidebar-primary-foreground hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </a>
      </div>
    </nav>
  </div>
</aside>
