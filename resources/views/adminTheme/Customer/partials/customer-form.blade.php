<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Customer Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update customer information") }}
        </p>
    </header>

    <form method="POST" action="{{ route("admin.customer.update", $customer) }}">
        @csrf
        @method('patch')
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-label-admin :required="true" for="first_name">{{ __("First name") }}</x-label-admin>
                <x-input-admin type="text" name="first_name" placeholder="Doudeline" :value="old('first_name', $customer->firstname)" required></x-input-admin>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="last_name">{{ __("Last name") }}</x-label-admin>
                <x-input-admin type="text" name="last_name" placeholder="Eugene" :value="old('last_name', $customer->name)" required></x-input-admin>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
            <div>
                <x-label-admin :required="true"  for="gender">{{ __("Gender") }}</x-label-admin>
                <x-select-admin type="text" name="gender" required>
                    <option {{ $customer->sexe == 'Male' ? 'selected' : '' }} value="Male">Masculin</option>
                    <option {{ $customer->sexe == 'Female' ? 'selected' : '' }}  value="Female">Feminin</option>
                </x-select-admin>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="identity_number">{{ __("Identity number") }}</x-label-admin>
                <x-input-admin type="text" name="identity_number" placeholder="" :value="old('identity_number', $customer->identity_number)"></x-input-admin>
                <x-input-error :messages="$errors->get('identity_number')" class="mt-2" />
            </div>
            <div>
                <x-label-admin for="email">{{ __("Email address") }}</x-label-admin>
                <x-input-admin type="email" name="email" :value="old('email', $customer->address->email)"></x-input-admin>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <div>
                <x-label-admin :required="true"  for="country" >{{ __("Country") }}</x-label-admin>
                <x-select-admin id="country2" type="text" name="country" required>
                    @foreach($countries as $country)
                        <option {{ $country->id == $customer->address->country ? 'selected' : '' }} value="{{ $country->id}}">{{ $country->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="state" >{{ __("Department") }}</x-label-admin>
                <x-select-admin id="state2" type="text" name="state" required>
                    @foreach($states as $state)
                        <option {{ $state->id == $customer->address->state ? 'selected' : '' }} value="{{ $state->id}}">{{ $state->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>


            <div>
                <x-label-admin :required="true"  for="city">{{ __("City") }}</x-label-admin>
                <x-input-admin type="text" name="city" placeholder="Trou-du-Nord" :value="old('city', $customer->address->city)"  required></x-input-admin>
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="phone">{{ __("Phone") }}</x-label-admin>
                <x-input-admin type="phone" name="phone" placeholder="+509 xxx xx xx" :value="old('phone', $customer->address->phone)" ></x-input-admin>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="typeofaccount">{{ __("Type Of Account") }}</x-label-admin>
                <select id="typeofaccount" name="typeofaccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    @foreach($typeofaccounts as $typeofaccount)
                        <option {{ $typeofaccount->id == $customer->typeofaccount ? 'selected' : '' }} value="{{ $typeofaccount->id}}">{{ $typeofaccount->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>
    </form>
</section>
