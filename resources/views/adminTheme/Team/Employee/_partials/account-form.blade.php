<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Employee Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's employee information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-label-admin :required="true"  for="branch" >{{ __("Branch") }}</x-label-admin>
            <x-select-admin id="branch" type="text" name="branch" required >
                @foreach($branches as $branch)
                    <option value="{{ $branch->id}}" {{ $branch->id == $employee->branch->id ? 'selected' : '' }}>{{ $branch->name}} </option>
                @endforeach
            </x-select-admin>
            <x-input-error :messages="$errors->get('branch')" class="mt-2" />
        </div>

        <div>
            <x-label-admin :required="true"  for="role" >{{ __("Role") }}</x-label-admin>
            <x-select-admin id="role" type="text" name="role" required>
                @foreach($roles as $role)
                    <option {{ $role->id == $employee->user->roles->first()->id ? 'selected' : '' }}">{{ $role->name}}</option>
                @endforeach
            </x-select-admin>
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'employee-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
