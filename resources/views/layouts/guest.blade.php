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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 relative">

        @if (Route::has('register') && Route::currentRouteName() === 'login')
            <div class="absolute top-4 right-4">
                <a href="{{ route('register') }}"
                    class="inline-block px-5 py-1.5 border text-[#1b1b18] border-[#19140035] hover:border-[#1915014a]
                    dark:text-[#EDEDEC] dark:border-[#3E3E3A] dark:hover:border-[#62605b]
                    rounded-sm text-sm leading-normal transition">
                    Register
                </a>
            </div>
        @endif

        <div>
            <a href="/">
                <img style="width: 50px;" src="{{ Vite::image('akarat.svg') }}" alt="Logo">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
