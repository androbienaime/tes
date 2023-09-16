<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Account') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="route('dashboard')">{{ __("Make deposit") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <x-breadcrumb />

    <x-flashmessage :status="session('status')" />
    @if(\Illuminate\Support\Facades\Session::exists('status'))
        <x-modal name="confirm-account-deletion" :show="true" focusable>
            <div class="p-5 text-green-500">
                <h1 class="text-3xl">{{ @session("status") }}</h1>
            </div>

            <div class="mt-6 p-2 flex justify-end">
                <x-secondary-button :style="'background-color:#00416d;color:white;'" x-on:click="$dispatch('close')">
                    {{ __('Ok') }}
                </x-secondary-button>
            </div>
        </x-modal>
    @endif
    <!-- Panel -->
    <x-primary-panel :cs="'bi bi-bank'" :title="__('Add an Account')">
        <div class="">
            <form method="POST" action="{{ route("admin.account.store") }}">
                @csrf

                <livewire:search-customer />
                <x-center-form>
                    <x-label-admin :required="true" for="typeofaccount">{{ __("Type Of Account") }}</x-label-admin>
                    <select id="typeofaccount" name="typeofaccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @foreach($typeofaccounts as $typeofaccount)
                            <option value="{{ $typeofaccount->id}}">{{ $typeofaccount->name}}</option>
                        @endforeach
                    </select>
                    <div class="mb-5"></div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>
                </x-center-form>
            </form>
        </div>
    </x-primary-panel>
    <div class="">
        <div class="max-w-7xl sm:px-6  ">
            <div class="bg-white overflow-hidden shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg">
                <div class="p-6 text-gray-900">
                    <livewire:account-table />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
