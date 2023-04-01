@php

@endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Employee Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's employee information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.employee.update', $employee) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-label-admin :required="true" for="first_name">{{ __("First name") }}</x-label-admin>
                <x-input-admin type="text" name="first_name" placeholder="Doudeline" :value="old('first_name', $employee->firstname)" required ></x-input-admin>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="last_name">{{ __("Last name") }}</x-label-admin>
                <x-input-admin type="text" name="last_name" placeholder="Eugene" :value="old('last_name', $employee->lastname)" required></x-input-admin>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="nickname">{{ __("Nickname") }}</x-label-admin>
                <x-input-admin type="text" name="nickname" placeholder="Eug" :value="old('nickname', $employee->user->name)" required></x-input-admin>
                <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="gender">{{ __("Gender") }}</x-label-admin>
                <x-select-admin type="text" name="gender" :value="old('gender', $employee->gender)" required>
                    <option value="Male">Masculin</option>
                    <option value="Female">Feminin</option>
                </x-select-admin>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div>
                <x-label-admin for="identity_number">{{ __("Identity number") }}</x-label-admin>
                <x-admin-id-mask :names="'identity_number'" :value="old('identity_number', $employee->identity_number)"/>
                <x-input-error :messages="$errors->get('identity_number')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true" for="email">{{ __("Email address") }}</x-label-admin>
                <x-input-admin type="email" name="email" :value="old('email', $employee->user->email)"  placeholder="eugenedoudeline@lestruviens.com"></x-input-admin>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <div>
                <x-label-admin :required="true"  for="country" >{{ __("Country") }}</x-label-admin>
                <x-select-admin id="country2" type="text" name="country" required>
                    @foreach($countries as $country)
                        <option @if($employee->address != null) {{ $country->id == $employee->address->country ? 'selected' : '' }} @endif value="{{ $country->id}}">{{ $country->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="state" va>{{ __("Department") }}</x-label-admin>
                <x-select-admin id="state2" type="text" name="state" required>
                    @foreach($states as $state)
                        <option value="{{ $state->id}}" @if($employee->address != null)  {{ $state->id == $employee->address->state ? 'selected' : '' }} @endif >{{ $state->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true"  for="city">{{ __("City") }}</x-label-admin>
                <x-input-admin type="text" name="city" placeholder="Trou-du-Nord" required  :value="old('city', $employee->address->city)"   />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div>
                <x-label-admin :required="true" for="phone">{{ __("Phone") }}</x-label-admin>
                <x-admin-input-mask-phone :names="'phone'"  :value="old('phone', $employee->address->phone)"  />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

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

                        <option {{ $role->id == $employee->user->roles->first()->id ? 'selected=' : ' ' }}" value="{{ $role->id }}">{{ $role->name}}</option>
                    @endforeach
                </x-select-admin>
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
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
