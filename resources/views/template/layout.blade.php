<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-rounded {
          font-family: 'Nunito', sans-serif;
        }
        
                /* Use Helvetica for all headings */
                h1, h2, h3, h4, h5, h6 {
                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                }
        
        .category-filter.active {
            @apply bg-[#242424] text-white border-[#242424];
        }
        
        .category-filter:not(.active) {
            @apply bg-white text-[#242424] border-[#242424];
        }
        
        .book-card {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hidden-card {
            @apply hidden;
        }
    </style>
</head>
<body class="font-rounded bg-white text-gray-900">
    <!-- Notification Display -->
    @include('components.notification-display')

    <div id="loading-screen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
        <div class="flex flex-col items-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-[#86FF79]"></div>
            <p class="mt-4 text-gray-600 font-medium animate-pulse">Memuat halaman...</p>
        </div>
    </div>
    <head>
        @yield('header')
    </head>
    <main class="container section">
        @yield('main')
    </main>
    <footer class="container section">
        @yield('footer')
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.category-filter');
            const bookCards = document.querySelectorAll('.book-card');

            // Set initial active button
            if (filterButtons.length > 0) {
                filterButtons[0].classList.add('active');
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const selectedCategory = this.getAttribute('data-category');

                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Filter books
                    bookCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        if (selectedCategory === 'all' || cardCategory === selectedCategory) {
                            card.classList.remove('hidden-card');
                            card.style.display = 'block';
                        } else {
                            card.classList.add('hidden-card');
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

    <script>
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 500);
        });
    </script>    
</body>
</html>