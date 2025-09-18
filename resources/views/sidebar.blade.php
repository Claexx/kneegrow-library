<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-[#EEE]">
    <aside class="fixed left-0 top-0 z-40 h-screen w-64 bg-sidebar bg-background">
        <div class="flex h-full flex-col">
          <div class="flex h-16 items-center px-6">
            <div class="flex items-center gap-2">
              <div class="h-8 w-8 rounded-lg bg-sidebar-primary flex items-center justify-center">
                <svg
                  class="h-5 w-5 text-sidebar-primary-foreground"
                  fill="none"
                  stroke="#0F0E0E"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                  />
                </svg>
              </div>
            </div>
          </div>

          <nav class="flex-1 space-y-1 px-3 py-4 ml-2 text-[#0F0E0E]">
            <div class="h-fit w-fit bg-white rounded-3xl py-2 shadow-2xl">
              <!-- HOME -->
              <a
                href="home"
                class="flex items-center gap-3 rounded-lg bg-sidebar-primary px-3 py-2 text-sidebar-primary-foreground"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 9.5L12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-5H9v5H4a1 1 0 0 1-1-1V9.5z"/>
                </svg>
              </a>
          
              <!-- KOLEKSI -->
              <a
                href="koleksi"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="4" width="7" height="16" rx="2"/>
                  <rect x="14" y="4" width="7" height="16" rx="2"/>
                </svg>
              </a>
          
              <!-- ANGGOTA -->
              <a
                href="anggota"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="8" cy="7" r="4"/>
                  <circle cx="17" cy="7" r="4"/>
                  <path d="M2 21v-2a5 5 0 0 1 5-5h3"/>
                  <path d="M22 21v-2a5 5 0 0 0-5-5h-3"/>
                </svg>
              </a>
          
              <!-- TRANSAKSI -->
              <a
                href="transaksi"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
              >
                <svg xmlns="http://www.w3.org/2000/svg" 
                width="24" height="24" viewBox="0 0 24 24" 
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
            <div class="h-fit w-fit bg-white rounded-3xl py-2 mt-2">
              <!-- NOTIFIKASI -->
              <a
                href="notifikasi"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15.019 17h-6.04m6.04 0h3.614c1.876 0 1.559-1.86.61-2.804C15.825 10.801 20.68 3 11.999 3s-3.825 7.8-7.243 11.196c-.913.908-1.302 2.804.61 2.804H8.98m6.039 0c0 1.925-.648 4-3.02 4s-3.02-2.075-3.02-4"/>
                </svg>
              </a>
          
              <!-- PENGATURAN -->
              <a
                href="pengaturan"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </a>
            </div>
          </nav>
        </div>
      </aside>

      <div class="pl-64">
        <header class="sticky top-0 z-30 flex h-16 items-center gap-4 bg-background px-6">
          <div class="flex flex-1 items-center gap-4">
            <nav class="flex items-center space-x-1 text-sm text-muted-foreground text-">
            </nav>
          </div>
          <div class="flex items-center gap-4">
            <button class="relative rounded-full p-2 text-muted-foreground hover:text-foreground bg-white">
              <svg class="h-5 w-5" fill="none" stroke="#0F0E0E" viewBox="0 0 24 24">
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M15 17h5l-5 5v-5zM9 7H4l5-5v5zm6 10V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h6a2 2 0 002-2z"
                />
              </svg>
              <span class="absolute -top-1 -right-1 h-3 w-3 rounded-full bg-secondary"></span>
            </button>
            <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center bg-white">
              <span class="text-sm font-medium text-primary-foreground text-[#0F0E0E]">JD</span>
            </div>
          </div>
        </header>
    
</body>
</html>