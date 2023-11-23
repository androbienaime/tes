<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('PAYMENT') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="{{ route('admin.customer.index') }}">{{ __("Add a Customer") }}</x-btn-header-admin>
                <x-btn-header-admin href="{{ route('admin.account.index') }}">{{ __("Add an Account") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <x-flashmessage :status="session('status')" />
    <x-flashmessage :status="session('error')" :warning="true" />

    <!-- Panel -->
    <div class='grid grid-cols-1 sm:px-6 mb-2 my-2'>
        <div class='col-span-1 bg-white col-span-1 rounded p-6 overflow-x'>
            <x-primary-panel :cs="'bi bi-cash'" :title="__('Make a payment')">
                <div class=" ">
                    <form method="POST" action="{{ route("admin.payment.store") }}">
                        @csrf
                        <x-center-form>
                            <!-- Name -->
                            <livewire:search-account-job />

                            <x-primary-button  :style="'background-color:#00416d;'">{{ __("Save") }}</x-primary-button>
                        </x-center-form>

                    </form>
                </div>
            </x-primary-panel>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:px-6">
        <div class='bg-white col-span-1 rounded p-6 overflow-x'>
            <livewire:transaction-table />
        </div>
    </div>
</x-admin-layout>
