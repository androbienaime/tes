<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex">
                {{ __('Dashboard') }}
                
                <!-- Right position -->
                <div class="absolute origin-top-right right-5">
                    <x-btn-header-admin href="route('dashboard')">{{ __("Faire un depot") }}</x-btn-header-admin>
                </div>
            </div>
        </h2>
    </x-slot>

    <!-- Panel (Add Customer) -->

    <div class="mb-2 border-solid border-grey-light rounded border shadow-sm m-5">
        <div class="bg-white px-2 py-3 text-gray-700 border border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
          <span class='text-md'><i class="bi bi-people-fill"></i> {{ __("Add Customer")  }}</span>
        </div>
        <div class="p-3">
            <div class="w-5/6 p-5">      
                <form method="POST" action="{{ route("createCustomer") }}">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <x-label-admin for="first_name">{{ __("First name") }}</x-label-admin>
                            <x-input-admin type="text" name="first_name" required></x-input-admin>
                        </div>
                        <div>
                            <x-label-admin for="last_name">{{ __("Last name") }}</x-label-admin>
                            <x-input-admin type="text" name="last_name" required></x-input-admin>
                        </div>
                        <div>
                            <x-label-admin for="gender">{{ __("Gender") }}</x-label-admin>
                            <select id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                <option value="M">Masculin</option>
                                <option value="F">Feminin</option>
                            </select>
                        </div>  
                        
                        <div>
                            <x-label-admin for="identity_number">{{ __("Identity number") }}</x-label-admin>
                            <x-input-admin type="tel" name="identity_number"></x-input-admin>
                        </div>
                        <div>
                            <x-label-admin for="email">{{ __("Email address") }}</x-label-admin>
                            <x-input-admin type="email" name="email"></x-input-admin>
                        </div>
                        <div>
                            <x-label-admin for="phone">{{ __("Phone") }} <span class="text-x1 text-green-700">(Optionel)</span></x-label-admin>
                            <x-input-admin  type="number" name="phone"></x-input-admin>
                        </div>
        
                        <div>
                            <x-label-admin for="country">{{ __("Country") }}</x-label-admin>
                            <x-input-admin type="text" name="country"></x-input-admin>
                        </div>
                        <div>
                            <x-label-admin for="city">{{ __("City") }}</x-label-admin>
                            <x-input-admin type="text" name="city"></x-input-admin>
                        </div>
        
                        <div>
                            <x-label-admin for="typeofaccount">{{ __("Type Of Account") }}</x-label-admin>
                            <select id="typeofaccount" name="typeofaccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option>PLAN 1</option>
                                <option>PLAN 2</option>
                            </select>
                        </div>
                    </div> 
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>
                </form>
            </div>
        </div>
      </div>

</x-admin-layout>
