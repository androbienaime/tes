<x-admin-layout>

    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Account History') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="{{ route('admin.account.index') }}">{{ __("Account") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl sm:px-6 py-2">

    </div>
    <div class="">
        <div class="max-w-7xl sm:px-6  ">
            @if($account)
                @if(!$account->type_of_account->active_case_payments)
                    <div class="bg-white overflow-hidden shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg">
                        <div class="p-6 text-gray-900">
                            <div class=" w-full p-5">
                                <livewire:history-accordion :account="$account" />
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <div class="bg-white overflow-hidden shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg">
                <div class="p-6 text-gray-900">
                    <div class=" w-full">
                        <div class="flex px-4 uppercase">
                            <span class="text-xl">NOM : {{ $account->customer->firstname }}</span>
                            <span class="text-xl px-4">NOM : {{ $account->customer->firstname }}</span>
                        </div>
                        @include("adminTheme.Account.partials.show-account-case", ['account' => $account, 'show_details' => true])
                    </div>
                </div>
        </div>
    </div>
</x-admin-layout>
