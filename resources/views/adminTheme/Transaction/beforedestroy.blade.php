<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
            <section class="space-y-6">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Delete Transaction') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your transaction is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </header>

                <x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >{{ __('Delete Transaction') }}</x-danger-button>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('admin.transaction.destroy', $transaction) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Are you sure you want to delete this transaction ?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-6">
                          <h1><strong>{{ __("ID TRANSACTION") }} : </strong> {{ $transaction->code }}</h1>
                          <h1><strong>{{ __("MONTANT") }} : </strong> {{ $transaction->amount . ' HTG' }}</h1>
                          <h1><strong>{{ __("EMPLOYEE") }} :
                              </strong> {{ $transaction->employee->lastname . ' ' . $transaction->employee->firstname }}</h1>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ml-3">
                                {{ __('Delete Transaction') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </section>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
