<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LTFINANCE') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" defer></script>
        @livewireStyles
        <style>
          [x-cloak] { display: none !important; }
      </style>
    </head>
    <body class="font-[Poppins] antialiased bg-gray-100">
          <div class="relative min-h-screen md:flex  " x-data="{ opens: true }">
              <!-- Sidebar -->
            @include("partials.sidebar")

            <!-- Main content -->
            <main class="flex-1 sm:ml-64 mb-5">
              <div class="">
                @include('partials.navigation')

                        <!-- Page Heading -->
                @if (isset($header))
                  <header class="bg-white shadow">
                      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                          {{ $header }}
                      </div>
                  </header>
                @endif
              </div>

              <div class="">
                  {{ $slot }}
              </div>
            </main>
          </div>
          @livewireScripts
          @livewireChartsScripts
    </body>
</html>
