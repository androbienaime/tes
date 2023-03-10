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
    <x-flashmessage :warning="true" :status="session('errors2')" />

    <!-- Panel -->

    <x-primary-panel :cs="'bi bi-cash'" :title="__('To make a payment')">
        <div class=" ">
            <form method="POST" action="{{ route("admin.payment.store") }}">
                @csrf
                <x-center-form>
                    <!-- Name -->
                    <livewire:search-account-job />

                    <x-primary-button>{{ __("Save") }}</x-primary-button>
                </x-center-form>
            </form>
        </div>
    </x-primary-panel>
    <div class="">
        <div class="max-w-7xl sm:px-6 ">
            <div class="bg-white overflow-hidden shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg ">
                <div class="p-6 text-gray-900">
                    <livewire:transaction-table />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
