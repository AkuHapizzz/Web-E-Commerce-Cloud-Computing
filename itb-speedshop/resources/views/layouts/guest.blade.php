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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900 text-white relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-600 rounded-full mix-blend-multiply filter blur-[100px] opacity-20"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-gray-600 rounded-full mix-blend-multiply filter blur-[100px] opacity-20"></div>

            <div class="z-10 text-center mb-8">
                <a href="/" class="text-4xl font-black tracking-tighter">
                    <span class="text-white">ITB.</span><span class="text-red-600">SpeedShop</span>
                </a>
            </div>

            <div class="z-10 w-full sm:max-w-md mt-6 px-8 py-8 bg-black/60 backdrop-blur-xl border border-gray-800 shadow-2xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
            
            <div class="z-10 mt-8 text-gray-500 text-sm font-medium">
                Sistem Informasi & Manajemen
            </div>
        </div>
    </body>
</html>
