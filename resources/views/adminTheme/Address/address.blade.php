<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl sm:px-6 ">
            <div class="bg-white overflow-hidden shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg">
                <div class="p-6 text-gray-900">
                    <livewire:address-table />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
