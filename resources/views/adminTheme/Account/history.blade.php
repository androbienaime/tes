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
        <div class="max-w-7xl sm:px-6">
            <div class="bg-white overflow-hidden shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg p-4">
                @if($account)
                        <x-html-print>
                            <div class="p-6 text-gray-900">
                                <div class=" w-full">
                                    <div class="p-2 text-center">
                                        <p> <span class="text-2xl text-blue-600 uppercase">{{ __("Account no : ". $account->code) }} </span></p>

                                        <p><span class="text-1xl text-blue-600 uppercase">{{ $account->customer->firstname . " " .
                                    $account->customer->name }}</span></p>
                                        <hr class="mb-2 h-5"/>
                                    </div>
                                    @if(!$account->type_of_account->active_case_payments)
                                        <livewire:history-accordion :account="$account" />
                                    @else
                                        @include("adminTheme.Account.partials.show-account-case", ['account' => $account, 'transaction'=>$transactions, 'show_details' => true])
                                    @endif
                                </div>
                            </div>
                        </x-html-print>
                    @endif
            </div>
        </div>
    </div>

</x-admin-layout>
