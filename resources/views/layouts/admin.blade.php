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
      
        <style>
          [x-cloak] { display: none !important; }
      </style>
    </head>
    <body class="font-[Poppins] antialiased">
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


                   <!-- Menu DropDown -->
                <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 
                cursor-pointer hover:bg-blue-600 text-white" onclick="dropdown('submenu1', 'arrow1')">
                    <i class="bi bi-person-add"></i>
                    <div class="flex justify-between w-full items-center">
                        <span class="text-[15px] ml-4 text-gray-200">{{ __("Account") }}</span>
                        <span class="text-sm rotate-180" id="arrow1">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </div>
                </div>

                <!-- SubMenu -->
                <div class="hidden text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="submenu1">
                  <a href="{{ route('customer') }}" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                    <i class="bi bi-1-circle-fill"></i>
                    {{ __("Register account") }}
                  </a>
                  <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                    <i class="bi bi-2-circle-fill"></i>
                    {{ __("Make deposit") }}
                  </a>
                  <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                    <i class="bi bi-3-circle-fill"></i>
                      {{ __("Withdraw") }}
                  </a>
              </div>

              
              <span class="text-gray-700 mt-3">Components</span>
                <!-- Menu DropDown -->
                <div class="p-2.5  flex items-center rounded-md px-4 duration-300 
                  cursor-pointer hover:bg-blue-600 text-white" onclick="dropdown('submenu2', 'arrow2')">
                     <i class="bi bi-people-fill"></i>
                      <div class="flex justify-between w-full items-center">
                          <span class="text-[15px] ml-4 text-gray-200">{{ __("Custumers") }}</span>
                          <span class="text-sm rotate-180" id="arrow2">
                              <i class="bi bi-chevron-down"></i>
                          </span>
                      </div>
                  </div>

                  <!-- SubMenu -->
                  <div class=" hidden text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="submenu2">
                    <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                      <i class="bi bi-1-circle-fill"></i>
                      {{ __("Custumers") }}
                    </a>
                    <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                      <i class="bi bi-2-circle-fill"></i>
                      {{ __("Adresses") }}
                    </a>
                </div>

                   <!-- Menu DropDown -->
                   <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 
                   cursor-pointer hover:bg-blue-600 text-white" onclick="dropdown('submenu3', 'arrow3')">
                       <i class="bi bi-bank2"></i>
                        <div class="flex justify-between w-full items-center">
                           <span class="text-[15px] ml-4 text-gray-200">{{ __("Modules") }}</span>
                           <span class="text-sm rotate-180" id="arrow3">
                               <i class="bi bi-chevron-down"></i>
                           </span>
                       </div>
                   </div>
 
                   <!-- SubMenu -->
                   <div class="hidden text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="submenu3">
                    <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                      <i class="bi bi-1-circle-fill"></i>
                      {{ __("Modules Manager") }}
                    </a>
                    <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                      <i class="bi bi-2-circle-fill"></i>
                      {{ __("Modules Catalog") }}
                    </a>
                 </div>

                 <span class="text-gray-700 mt-3">Plus</span>
                  <!-- Menu DropDown -->
                  <div class="p-2.5 flex items-center rounded-md px-4 duration-300 
                  cursor-pointer hover:bg-blue-600 text-white" onclick="dropdown('submenu4', 'arrow4')">
                      <i class="bi bi-gear"></i>
                      <div class="flex justify-between w-full items-center">
                          <span class="text-[15px] ml-4 text-gray-200">{{ __("Settings") }}</span>
                          <span class="text-sm rotate-180" id="arrow4">
                              <i class="bi bi-chevron-down"></i>
                          </span>
                      </div>
                  </div>

                  <!-- SubMenu -->
                  <div class="hidden text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="submenu4">
                    <a href="#" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                      <i class="bi bi-1-circle-fill"></i>
                      {{ __("Employees") }}
                    </a>
                    <a href="{{ route("branch") }}" class="block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">
                      <i class="bi bi-2-circle-fill"></i>
                      {{ __("Branch") }}
                    </a>
                </div>
                
                <div class="p-2.5 flex items-center rounded-md px-4 duration-300 
                  cursor-pointer hover:bg-blue-600 text-white">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <div class="flex justify-between w-full items-center">
                    <x-side-nav-link href="{{ route('dashboard') }}">
                      {{ __("Log out") }}
                    </x-side-nav-link>
                  </div>
                </div>

                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 bg-gray-100 h-screen sm:ml-64 mb-5">
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

          
       <script type="text/javascript">
        function dropdown($nom1, $nom2){
            document.querySelector("#"+$nom1).classList.toggle("hidden");
            document.querySelector("#"+$nom2).classList.toggle("rotate-0");
        }
        dropdown();
      </script>
    </body>
</html>
