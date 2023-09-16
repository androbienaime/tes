<x-center-form :class="''">
    <section class="space-y-6 py-2">

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-account-deletion')"
        >{{ __('Delete Account') }}</x-danger-button>

        <x-modal name="confirm-account-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.account.destroy', $account) }}" class="p-6">
                @csrf
                @method('delete')
                <input type="hidden" name="code" value="{{ $account->code }}" />
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete this account ?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once the account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <h1><strong>{{ __("ACCOUNT NO") }} : </strong> {{ $account->code }}</h1>
                    <h1><strong>{{ __("BALANCE") }} : </strong> {{ $account->balance . ' HTG' }}</h1>
                    <h1><strong>{{ __("FULL NAME") }} :
                        </strong> {{ $account->customer->name . ' ' . $account->customer->firstname }}</h1>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </section>
</x-center-form>
