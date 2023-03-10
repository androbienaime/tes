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

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-label-admin :required="true"  for="country" >{{ __("Country") }}</x-label-admin>
                <x-select-admin id="country2" type="text" name="country" required>
                    @foreach($countries as $country)
                        <option {{ $country->id == $employee->address->country ? 'selected' : '' }} value="{{ $country->id}}">{{ $country->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="state" va>{{ __("Department") }}</x-label-admin>
                <x-select-admin id="state2" type="text" name="state" required>
                    @foreach($states as $state)
                        <option value="{{ $state->id}}" {{ $state->id == $employee->address->state ? 'selected' : '' }} >{{ $state->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="city">{{ __("City") }}</x-label-admin>
                <x-input-admin type="text" name="city" placeholder="Trou-du-Nord" :value="old('city', $employee->address->city)"  required></x-input-admin>
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true" for="phone">{{ __("Phone") }}</x-label-admin>
                <x-input-admin type="phone" name="phone" placeholder="+509 xxx xx xx"  :value="old('phone', $employee->address->phone)"></x-input-admin>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

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
