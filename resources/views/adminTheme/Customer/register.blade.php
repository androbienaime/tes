<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex">

                {{ __('Register Customer') }}

                <!-- Right position -->
                <div class="absolute origin-top-right right-5">
                    <x-btn-header-admin href="{{ route('admin.deposit.index') }}">{{ __("Faire un depot") }}</x-btn-header-admin>
                </div>
            </div>
        </h2>
    </x-slot>

    <x-flashmessage :status="session('status')" />
    @if(\Illuminate\Support\Facades\Session::exists('status'))
        <x-admin-modal > {{ @session("status") }}</x-admin-modal>
    @endif
    <!-- Panel (Add Customer) -->
    <x-primary-panel :cs="'bi bi-people-fill'" :title="__('Add a Customer')">
            <div class="w-5/6 p-5">
                <form method="POST" action="{{ route("admin.customer.store") }}">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <x-label-admin :required="true" for="first_name">{{ __("First name") }}</x-label-admin>
                            <x-input-admin type="text" name="first_name" placeholder="Doudeline" required></x-input-admin>
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-label-admin :required="true"  for="last_name">{{ __("Last name") }}</x-label-admin>
                            <x-input-admin type="text" name="last_name" placeholder="Eugene" required></x-input-admin>
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-label-admin :required="true"  for="gender">{{ __("Gender") }}</x-label-admin>
                            <x-select-admin type="text" name="gender" required>
                                <option value="Male">Masculin</option>
                                <option value="Female">Feminin</option>
                            </x-select-admin>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <div>
                            <x-label-admin for="identity_number">{{ __("Identity number") }}</x-label-admin>
                            <x-admin-id-mask :names="'identity_number'"/>
                            <x-input-error :messages="$errors->get('identity_number')" class="mt-2" />
                        </div>
                        <div>
                            <x-label-admin for="email">{{ __("Email address") }}</x-label-admin>
                            <x-input-admin type="email" name="email" placeholder="eugenedoudeline@lestruviens.com"></x-input-admin>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

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
                            <x-input-admin type="text" name="city" placeholder="Trou-du-Nord"  required></x-input-admin>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div>
                            <x-label-admin :required="true" for="phone">{{ __("Phone") }}</x-label-admin>
                            <x-admin-input-mask-phone :names="'phone'" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-label-admin for="typeofaccount">{{ __("Type Of Account") }}</x-label-admin>
                            <select id="typeofaccount" name="typeofaccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                @foreach($typeofaccounts as $typeofaccount)
                                    <option value="{{ $typeofaccount->id}}">{{ $typeofaccount->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-label-admin for="references_person">{{ __("Reference person") }}</x-label-admin>
                            <x-input-admin type="text" name="reference_person" placeholder=" " ></x-input-admin>
                            <x-input-error :messages="$errors->get('references_person')" class="mt-2" />
                        </div>

                        <div>
                            <x-label-admin for="phone_2">{{ __("Telephone number") }}</x-label-admin>
                            <x-admin-input-mask-phone :names="'phone_2'" />
                            <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
                        </div>

                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>

                </form>
            </div>

    </x-primary-panel>
    <div class="">
        <div class="max-w-7xl sm:px-6 ">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-6 text-gray-900">
                    <livewire:customer-table />
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#country2").change(function (event){
                var id_input = this.value;
                $("#state2").html('');
                $("#city2").html('');

                    $.ajax({
                        url: '/api/fetch-state',
                        type: 'POST',
                        dataType: 'json',
                        data: {country_id : id_input,_token: "{{ csrf_token() }}"},
                        success:function (response){
                            $("#state2").html("<option value=''>{{ __("Select State") }}</option>");
                            $.each(response.states, function (index, val){
                                $("#state2").append("<option value='"+val.id+"'>"+val.name+"</option>");
                            });
                        }
                    });
            });
        });

    </script>
</x-admin-layout>
