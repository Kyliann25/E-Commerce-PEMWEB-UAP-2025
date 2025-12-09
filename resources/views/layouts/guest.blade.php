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
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white md:bg-gray-50 px-4">
            <div>
                <a href="/">
                    <h1 class="font-header text-5xl font-bold tracking-tighter text-hubbub-black uppercase hover:text-hubbub-pink transition-colors">HUBBUB</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-6 py-8 md:px-8 md:py-10 bg-white border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
