<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    @can("access-settings")
                        @include("adminTheme.partials.cards")
                        <livewire:chart-component />
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
