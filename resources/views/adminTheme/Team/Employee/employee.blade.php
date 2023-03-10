<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="{{ route('admin.employee.create') }}">{{ __("Add new Employee") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <x-admin-tab>
        <li class="mr-2">
            <x-admin-link-tab :href="route('admin.employee.index')" :active="request()->routeIs('admin.employee.index')">{{ __("Employee") }}</x-admin-link-tab>
        </li>
        <li class="mr-2">
            <x-admin-link-tab :href="route('admin.employee.index')" :active="request()->routeIs('logout')">{{ __("Profile") }}</x-admin-link-tab>
        </li>
    </x-admin-tab>

    <div class="py-5">
        <div class="max-w-7xl sm:px-6 ">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-6 text-gray-900">
                    <livewire:employee-table />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
