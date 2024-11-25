<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex w-full justify-center items-center">
            <div class="w-full p-lg-6 items-center mt-6 px-6 bg-white overflow-hidden">
                {{ $slot }}
            </div>
            <div class="col-8 w-full object-cover">
                <img src="{{ asset('assets/background.png') }}" class="object-cover" style="max-width: 100%" alt="">
            </div>
        </div>
    </body>
</html>
