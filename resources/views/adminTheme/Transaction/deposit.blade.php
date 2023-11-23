<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Deposit') }}
            </h2>

            <!-- Right position -->
            <div class="flex absolute origin-top-right right-5 sm:flex align-middle">
                <x-btn-header-admin href="{{ route('admin.customer.index') }}">{{ __("Add a Customer") }}</x-btn-header-admin>
                <x-btn-header-admin href="{{ route('admin.account.index') }}">{{ __("Add an Account") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <x-flashmessage :status="session('status')" />
    <x-flashmessage :warning="true" :status="session('errors2')" />

    <!-- Panel -->
    <div class='grid grid-cols-1 sm:px-6 mb-2 my-2'>
        <div class='col-span-1 bg-white col-span-1 rounded p-6 overflow-x'>
            <x-primary-panel :cs="'bi bi-cash'" :title="__('To make a deposit')">
                <livewire:custom.deposit />
            </x-primary-panel>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:px-6 my-2">
        <div class='bg-white col-span-1 rounded p-6 overflow-x'>
            <livewire:transaction-table />
        </div>
    </div>
</x-admin-layout>
