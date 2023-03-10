<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee') }}
            </h2>

            <!-- Right position -->
            <div class="absolute origin-top-right right-5">
                <x-btn-header-admin href="{{ route('admin.employee.index') }}">{{ __("Show Employees") }}</x-btn-header-admin>
            </div>
        </div>
    </x-slot>

    <x-flashmessage :status="session('status')" />
    @if(count($errors) > 0)
        <x-flashmessage :class="'bg-red-100 border-red-400 text-red-700'" :status="__('Erreurs lors du remplissage du formulaire')" />
    @endif
    <!-- Panel (Add Customer) -->
    <x-primary-panel :cs="'bi bi-people-fill'" :title="__('Add a Employee')">
        <div class="w-5/6 p-5">
            <form method="POST" action="{{ route("admin.employee.store") }}">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-label-admin :required="true" for="first_name">{{ __("First name") }}</x-label-admin>
                        <x-input-admin type="text" name="first_name" placeholder="Doudeline" :value="old('first_name')" required ></x-input-admin>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="last_name">{{ __("Last name") }}</x-label-admin>
                        <x-input-admin type="text" name="last_name" placeholder="Eugene" :value="old('last_name')" required></x-input-admin>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="nickname">{{ __("Nickname") }}</x-label-admin>
                        <x-input-admin type="text" name="nickname" placeholder="Eug" :value="old('nickname')" required></x-input-admin>
                        <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="gender">{{ __("Gender") }}</x-label-admin>
                        <x-select-admin type="text" name="gender" :value="old('gender')" required>
                            <option value="Male">Masculin</option>
                            <option value="Female">Feminin</option>
                        </x-select-admin>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true" for="identity_number">{{ __("Identity number") }}</x-label-admin>
                        <x-input-admin type="text" name="identity_number" :value="old('identity_number')" placeholder=""></x-input-admin>
                        <x-input-error :messages="$errors->get('identity_number')" class="mt-2" />
                    </div>
                    <div>
                        <x-label-admin :required="true" for="email">{{ __("Email address") }}</x-label-admin>
                        <x-input-admin type="email" name="email" :value="old('email')"  placeholder="eugenedoudeline@lestruviens.com"></x-input-admin>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>

                    <div>
                        <x-label-admin :required="true"  for="branch" >{{ __("Branch") }}</x-label-admin>
                        <x-select-admin id="branch" type="text" name="branch" required >
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id}}">{{ $branch->name}}</option>
                            @endforeach
                        </x-select-admin>
                        <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="country" >{{ __("Country") }}</x-label-admin>
                        <x-select-admin id="country2" type="text" name="country" required>
                            @foreach($countries as $country)
                                <option @if($country->name == 'Haiti') selected @endif value="{{ $country->id}}">{{ $country->name}}</option>
                            @endforeach
                        </x-select-admin>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="state" >{{ __("Department") }}</x-label-admin>
                        <x-select-admin id="state2" type="text" name="state" required>
                            @foreach($states as $state)
                                <option @if($state->name == 'Nord-Est') selected @endif value="{{ $state->id}}">{{ $state->name}}</option>
                            @endforeach
                        </x-select-admin>
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="city">{{ __("City") }}</x-label-admin>
                        <x-input-admin type="text" name="city" placeholder="Trou-du-Nord" :value="old('city')"  required></x-input-admin>
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true" for="phone">{{ __("Phone") }}</x-label-admin>
                        <x-input-admin type="phone" name="phone" placeholder="+509 xxx xx xx"  :value="old('phone')"></x-input-admin>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-label-admin :required="true"  for="role" >{{ __("Role") }}</x-label-admin>
                        <x-select-admin id="role" type="text" name="role" required>
                            @foreach($roles as $role)
                                <option @if($role->name=="Cashier") selected @endif value="{{ $role->id}}">{{ $role->name}}</option>
                            @endforeach
                        </x-select-admin>
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                      type="password"
                                      name="password_confirmation" required />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>
            </form>
        </div>
    </x-primary-panel>

</x-admin-layout>
