<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Withdrawal') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5 sm:flex">
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
            <x-primary-panel :cs="'bi bi-cash'" :title="__('Make a withdrawal')">
                <div class=" ">
                    <form method="POST" action="{{ route("admin.withdraw.store") }}">
                        @csrf
                        <x-center-form>
                            <!-- Name -->
                            <livewire:search-account-job />

                            <div class="mb-5">
                                <x-label-admin :required="true" for="amount" :value="__('Amount')" />
                                <div class="flex">
                                  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    HTG
                                  </span>
                                    <input type="text" id="website-admin" name="amount" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                </div>
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                            </div>

                            <x-primary-button :style="'background-color:#00416d;'">{{ __("Save") }}</x-primary-button>
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
