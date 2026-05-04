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
</head>
<body class="min-h-screen bg-white text-gray-900">
    <!-- Notification Display -->
    @include('components.notification-display')

    <head>
        @yield('header')
    </head>
    <main class="container section">
        @yield('main')
    </main>
    <footer class="container section">
        @yield('footer')
    </footer>
</body>
</html>