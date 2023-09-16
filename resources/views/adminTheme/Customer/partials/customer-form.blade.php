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
                    <option {{ $customer->gender == 'Male' ? 'selected' : '' }} value="Male">Masculin</option>
                    <option {{ $customer->gender == 'Female' ? 'selected' : '' }}  value="Female">Feminin</option>
                </x-select-admin>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="identity_number">{{ __("Identity number") }}</x-label-admin>
                <x-admin-id-mask :names="'identity_number'" :value="old('identity_number', $customer->identity_number)"/>
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
                <x-label-admin :required="true" for="phone">{{ __("Phone") }}</x-label-admin>
                <x-admin-input-mask-phone :names="'phone'" :value="old('phone', $customer->address->phone)"/>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="references_person">{{ __("Reference person") }}</x-label-admin>
                <x-input-admin type="text" name="reference_person" placeholder=" " :value="old('reference_person', @isset($customer->Reference_people->first()->full_name) ? $customer->Reference_people->first()->full_name : '')"  ></x-input-admin>
                <x-input-error :messages="$errors->get('references_person')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="phone_2">{{ __("Telephone number") }}</x-label-admin>
                <x-admin-input-mask-phone :names="'phone_2'" :value="old('phone_2', @isset($customer->Reference_people->first()->phone) ? $customer->Reference_people->first()->phone : '')"/>
                <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Update") }}</button>
    </form>
</section>
