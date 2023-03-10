<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flashmessage :status="session('status')" />
            <x-flashmessage :warning="true" :status="session('errors2')" />

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include("adminTheme.Team.Employee._partials.personal-info-form")
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include("adminTheme.Team.Employee._partials.password-form")
                </div>
            </div>


{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('adminTheme.Team.Employee._partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</x-admin-layout>
