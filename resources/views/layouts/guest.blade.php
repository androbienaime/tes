<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/jpg" href="{{ asset("img/logo.ico") }}"/>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <img class="mx-auto" src="{{ asset("img/logo.png") }}" alt="LT FINANCE"/>
                </a>
                <span class="block py-2 text-xs text-gray-600 sm:text-center  text-center dark:text-gray-400">Version 1.0.0</span>
            </div>

            <div class="w-3/4 sm:max-w-md sm:px-6 lg:px-8 mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>

            <div class="py-6">
                @include("AdminTheme.partials.footer")
            </div>
        </div>

    </body>
</html>
