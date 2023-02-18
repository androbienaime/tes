<x-admin-layout>

  <x-slot name="header">
    <div class="flex flex-row">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Branch') }}
      </h2>

    <!-- Right position -->
    <div class="absolute origin-top-right right-5">
      <x-btn-header-admin href="route('dashboard')">{{ __("Add Branch") }}</x-btn-header-admin>
    </div>
      </div>
  </x-slot>
    @if(isset($request->event))
        <header class="lg:fixed lg:top-0 bg-white shadow text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 p-4 mb-4 ">
            </div>
        </header>
    @endif


<!-- Breadcrumb -->
<nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
      <li class="inline-flex items-center">
        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
          <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
          Home
        </a>
      </li>
      <li>
        <div class="flex items-center">
          <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
          <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
          <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Flowbite</span>
        </div>
      </li>
    </ol>
  </nav>

    <x-flashmessage :status="session('status')" />
  <!-- Panel -->
  <div class="max-w-7xl mb-2 border-solid border-grey-light rounded border shadow-sm m-5 ">
    <div class="bg-white px-2 py-3 text-gray-700 border border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
      <span class='text-md'><i class="bi bi-git"></i> {{ __("Add Branch") }}</span>
    </div>
    <div class="p-3 bg-white">
      <div class="flex mx-auto w-1/2 p-5 items-center">
        <form method="POST" action="{{ route("admin.branch.store") }}">
            @csrf

            <!-- Name -->
            <div class="mb-6 ">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" placeholder="Centrale LesTruviens B.G " type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2 border p-2">

                <div>
                  <x-label-admin for="state" >{{ __("Department") }}</x-label-admin>
                  <x-select-admin id type="text" name="state" required>
                      <option value="Nord-est">Nord'est</option>
                  </x-select-admin>
                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>

                <div>
                  <x-label-admin for="city">{{ __("City") }}</x-label-admin>
                  <x-select-admin type="text" name="city" required>
                      <option value="Trou-du-Nord">Trou-du-nord</option>
                  </x-select-admin>
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div>
                    <x-label-admin for="address">{{ __("Address") }}</x-label-admin>
                    <x-input-admin type="text" name="address1" placeholder="#76, Rue poudriere, Trou-du-Nord" required></x-input-admin>
                    <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                </div>

                <div>
                    <x-label-admin for="phone">{{ __("Phone") }}</x-label-admin>
                    <x-input-admin type="text" name="phone" placeholder="+509 33356231"></x-input-admin>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Save") }}</button>
        </form>
    </div>
    </div>
  </div>

  <div class="">
    <div class="max-w-7xl sm:px-6 ">
        <div class="bg-white overflow-hidden shadow-sm ">
            <div class="p-6 text-gray-900">
                <livewire:branch-table />
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
