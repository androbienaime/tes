<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Customer') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="{{ route('admin.customer.index') }}">{{ __("Show Customer") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flashmessage :status="session('status')" />

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include("adminTheme.Customer.partials.customer-form")
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
