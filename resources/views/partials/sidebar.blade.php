<!-- Sidebar -->
<aside :class="{ '-translate-x-full': opens }" class="md:fixed lg:fixed right-0 z-10 bg-gray-900 text-blue-100 w-64 px-2 py-4 absolute inset-y-0 left-0 md:relative transform
             md:translate-x-0 overflow-y-auto
              transition ease-in-out duration-200 shadow-lg">
    <!-- Logo -->
    <div class="flex align-items-center justify-between px-2">
        <div class="block flex items-center space-x-2">
            <a class="text-white" href="{{ route('dashboard') }}">
                <img  src="{{ asset("img/logo.png") }}" class="w-9 object-center" alt="LT FINANCE"/>
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
                {{ __("Account Management") }}
            </x-admin-nav-sub-link>

            <x-admin-nav-sub-link :href="route('admin.deposit.index')" :active="request()->routeIs('admin.deposit.index')" >
                <i class="bi bi-2-circle-fill"></i>
                {{ __("Make deposit") }}
            </x-admin-nav-sub-link>

            <x-admin-nav-sub-link :href="route('admin.withdraw.index')" :active="request()->routeIs('admin.withdraw.index')" >
                <i class="bi bi-3-circle-fill"></i>
                {{ __("Withdraw") }}
            </x-admin-nav-sub-link>

            <x-admin-nav-sub-link :href="route('admin.payment.index')" :active="request()->routeIs('admin.payment.index')" >
                <i class="bi bi-4-circle-fill"></i>
                {{ __("Make a payment") }}
            </x-admin-nav-sub-link>



        </x-admin-sidebar-menu-dropdown>

        <span class="text-gray-700 mt-3">{{ __("Components") }}</span>
        {{-- Customer Menu --}}
        <x-admin-sidebar-menu-dropdown :iconLeft="'bi bi-people-fill'" :titles="'Custumers'">
            <x-admin-nav-sub-link :href="route('admin.customer.index')" :active="request()->routeIs('admin.customer.index')">
                <i class="bi bi-1-circle-fill"></i>
                {{ __("Custumers") }}
            </x-admin-nav-sub-link>

            @can("access-settings")
            <x-admin-nav-sub-link :href="route('admin.address.index')" :active="request()->routeIs('admin.address.index')" >
                <i class="bi bi-2-circle-fill"></i>
                {{ __("Adresses") }}
            </x-admin-nav-sub-link>
            @endcan

        </x-admin-sidebar-menu-dropdown>

        @can("access-settings")
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
        @endcan

        @can("access-settings")
        <span class="text-gray-700 mt-3">Plus</span>
        {{-- Setting Menu --}}
        <x-admin-sidebar-menu-dropdown :iconLeft="'bi bi-gear'" :titles="'Settings'">
            <x-admin-nav-sub-link :href="route('admin.employee.index')" :active="request()->routeIs('admin.employee.index')">
                <i class="bi bi-1-circle-fill"></i>
                {{ __("Team") }}
            </x-admin-nav-sub-link>

            <x-admin-nav-sub-link :href="route('admin.branch.index')" :active="request()->routeIs('admin.branch.index')">
                <i class="bi bi-2-circle-fill"></i>
                {{ __("Branch") }}
            </x-admin-nav-sub-link>

            <x-admin-nav-sub-link :href="route('admin.typeofaccount.index')" :active="request()->routeIs('admin.typeofaccount.index')">
                <i class="bi bi-2-circle-fill"></i>
                {{ __("Type Of Account") }}
            </x-admin-nav-sub-link>

            <x-admin-nav-sub-link :href="route('admin.report.index')" :active="request()->routeIs('admin.report.index')">
                <i class="bi bi-2-circle-fill"></i>
                {{ __("Report") }}
            </x-admin-nav-sub-link>

        </x-admin-sidebar-menu-dropdown>
        @endcan

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
