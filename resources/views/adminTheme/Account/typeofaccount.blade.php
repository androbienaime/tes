<x-admin-layout>

    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Type Of Account') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="route('dashboard')">{{ __("Add Account") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <x-breadcrumb />

    <x-flashmessage :status="session('status')" />
    <!-- Panel -->

    <x-primary-panel :cs="'bi bi-git'" :title="__('Add a Branch')">
        <div class="flex mx-auto w-1/2 p-5 items-center">
            <form method="POST" action="{{ route("admin.typeofaccount.store") }}">
                @csrf

                <!-- Name -->
                <div class="mb-6 ">
                    <x-label-admin :required="true"  for="name">{{ __("Echelon") }}</x-label-admin>
                    <x-input-admin id="name" placeholder="" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-2 border p-2">

                    <div>
                        <x-label-admin for="price">{{ __("Price / HTG") }}</x-label-admin>
                        <x-input-admin type="number" name="price" placeholder="" required></x-input-admin>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin for="duration">{{ __("Duration / MONTH") }}</x-label-admin>
                        <x-input-admin type="number" name="duration" placeholder="" required></x-input-admin>
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>
                </div>

                    <div>
                    <x-label-admin :required="true"  for="active_case_payment">{{ __("CASE PAYMENTS") }}</x-label-admin>
                    <x-select-admin type="text" name="active_case_payment" required>
                        <option value="0">{{ __("NO") }}</option>
                        <option value="1">{{ __("YES") }}</option>
                    </x-select-admin>
                    <x-input-error :messages="$errors->get('active_case_payment')" class="mt-2" />

                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>
            </form>
        </div>
    </x-primary-panel>
    <div class="">
        <div class="max-w-7xl sm:px-6 ">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-6 text-gray-900">
                    <livewire:type-of-account-table />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
