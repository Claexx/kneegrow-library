<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-rounded {
          font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="font-rounded">
    <head>
        @yield('header')
    </head>
    <main>
        @yield('main')
    </main>
    <footer>
        @yield('footer')
    </footer>
</body>
</html>