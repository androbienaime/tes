@php
    use \Illuminate\Support\Facades\Session;

    $routeBreadcrumb = Route::getCurrentRoute()->action["as"];
    $nameBreadcrumb = "";
    try{
        $nameBreadcrumb = ucfirst(explode(".", $routeBreadcrumb)[1]);
    }catch (Exception $e){

    }
    if(!Session::exists("sessionBread")){
        Session::push("sessionBread",
        ['route'=> $routeBreadcrumb, 'name'=> $nameBreadcrumb]);
    }else{

        foreach (Session::get("sessionBread") as $sb){
            if($sb['route'] != $routeBreadcrumb){
                if($sb['name'] == $nameBreadcrumb){
                    Session::push("sessionBread",
                    ['route'=> $routeBreadcrumb, 'name'=> $nameBreadcrumb]);
                }else{
                    Session::forget("sessionBread");

                    Session::push("sessionBread",
                    ['route'=> $routeBreadcrumb, 'name'=> $nameBreadcrumb]);
                }
            }
        }

    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TEST') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

        @livewireStyles
        <style>
          [x-cloak] { display: none !important; }
      </style>
    </head>
    <body class="font-[Poppins] antialiased bg-gray-100">
          <div class="relative min-h-screen md:flex  " x-data="{ opens: true }">
            <!-- Sidebar -->
            <aside :class="{ '-translate-x-full': !opens }" class="md:fixed lg:fixed right-0 z-10 bg-gray-900 text-blue-100 w-64 px-2 py-4 absolute inset-y-0 left-0 md:relative transform
             md:translate-x-0 overflow-auto  transition ease-in-out duration-200 shadow-lg">
                <!-- Logo -->
                <div class="flex align-items-center justify-between px-2">
                  <div class="block flex items-center space-x-2">
                    <a class="text-white" href="{{ route('dashboard') }}">
                      <img  src="{{ asset("img/logo.png") }}" class="w-9 object-center	 " alt="LT FINANCE"/>

                    </a>
                    <span class="text-2xl font-extrabold">LT FINANCE</span>
                  </div>
                  <button  type="button" @click="opens = !opens" class="md:hidden inline-flex p-2 items-center justify-center rounded-md text-white hover:bg-blue-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>

                  <hr class="my-2 text-gray-600"/>
                </div>

                  <!-- Search -->
                  <div class="p-1 mt-4 flex items-center rounded-md px-2 duration-300
                  cursor-pointer bg-gray-700 text-white">
                      <i class="bi bi-search text-sm cursor-pointer"></i>
                      <input type="text" placeholder="{{__("Search")}}..." class="text-[15px] ml-4 w-full bg-transparent"/>
                  </div>
                  <hr class="my-2 bg-gray-100"/>

                <!-- Nav Link -->
                <nav class="mt-4">
                  <span class="text-gray-700 py-5">General</span>
                  <x-side-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <i class="bi bi-speedometer"></i>
                      <span class="p-2.5"> {{ __("Dashboard") }} </span>
                  </x-side-nav-link>

                    {{-- Account Menu --}}
                    <x-admin-sidebar-menu-dropdown :iconLeft="'bi bi-person-add'" :titles="'Account'" >
                        <x-admin-nav-sub-link :href="route('admin.account.index')" :active="request()->routeIs('admin.account.index')" >
                            <i class="bi bi-1-circle-fill"></i>
                            {{ __("Register account") }}
                        </x-admin-nav-sub-link>

                        <x-admin-nav-sub-link :href="route('admin.deposit.index')">
                            <i class="bi bi-2-circle-fill"></i>
                            {{ __("Make deposit") }}
                        </x-admin-nav-sub-link>

                        <x-admin-nav-sub-link >
                            <i class="bi bi-3-circle-fill"></i>
                            {{ __("Withdraw") }}
                        </x-admin-nav-sub-link>

                    </x-admin-sidebar-menu-dropdown>

                <span class="text-gray-700 mt-3">{{ __("Components") }}</span>
                {{-- Customer Menu --}}
                <x-admin-sidebar-menu-dropdown :iconLeft="'bi bi-people-fill'" :titles="'Custumers'">
                    <x-admin-nav-sub-link :href="route('admin.customer.index')">
                        <i class="bi bi-1-circle-fill"></i>
                        {{ __("Custumers") }}
                    </x-admin-nav-sub-link>

                    <x-admin-nav-sub-link >
                        <i class="bi bi-2-circle-fill"></i>
                        {{ __("Adresses") }}
                    </x-admin-nav-sub-link>

                </x-admin-sidebar-menu-dropdown>

                {{-- Modules Menu --}}
                <x-admin-sidebar-menu-dropdown :iconLeft="'bi bi-bank2'" :titles="'Modules'">
                    <x-admin-nav-sub-link >
                        <i class="bi bi-1-circle-fill"></i>
                        {{ __("Modules Manager") }}
                    </x-admin-nav-sub-link>

                    <x-admin-nav-sub-link >
                        <i class="bi bi-2-circle-fill"></i>
                        {{ __("Modules Catalog") }}
                    </x-admin-nav-sub-link>

                </x-admin-sidebar-menu-dropdown>

                <span class="text-gray-700 mt-3">Plus</span>
                {{-- Setting Menu --}}
                <x-admin-sidebar-menu-dropdown :iconLeft="'bi bi-gear'" :titles="'Settings'">
                    <x-admin-nav-sub-link >
                        <i class="bi bi-1-circle-fill"></i>
                        {{ __("Employees") }}
                    </x-admin-nav-sub-link>

                    <x-admin-nav-sub-link :href="route('admin.branch.index')">
                        <i class="bi bi-2-circle-fill"></i>
                        {{ __("Branch") }}
                    </x-admin-nav-sub-link>

                    <x-admin-nav-sub-link :href="route('admin.typeofaccount.index')">
                        <i class="bi bi-2-circle-fill"></i>
                        {{ __("Type Of Account") }}
                    </x-admin-nav-sub-link>

                </x-admin-sidebar-menu-dropdown>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                  <x-side-nav-link href="{{ route('logout') }}" :active="request()->routeIs('logout')"
                                   onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span class="p-2.5"> {{ __("Log out") }} </span>
                  </x-side-nav-link>
                </form>

                </nav>
            </aside>

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
    </body>
</html>
