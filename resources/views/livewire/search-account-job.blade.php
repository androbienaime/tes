<div>
    <div class="grid gap-6 mb-2 md:grid-cols-2 border p-2">
        <!-- Name -->
        <div>
            <x-label-admin :required="true" for="code" :value="__('Code Customer')" />
            <x-input-admin id="code" wire:model="query" class="block mt-1 w-full" type="text" name="code" required/>
            <x-input-error :messages="$error" class="mt-2 mx-auto" />
        </div>

        <!-- Name -->
        <div>
            <x-label-admin   for="name" :value="__('Full Name')" />
            <x-input-admin id="name" class="block mt-1 w-full  {{ $classes }} " type="text" name="name" value="{{ $customer }}" required disabled="true"/>
        </div>

        <div class="mb-1">
            <x-label-admin   for="name" :value="__('Reference Person')" />
            <x-input-admin id="name" class="block mt-1 w-full {{ $classes_r }} " type="text" name="name" value="{{ $references_person }}" required disabled="true"/>
        </div>
    </div>
    <div class="mb-1">
        <x-label-admin for="name" :value="__('Current balance')" />
        <x-input-admin :style="'background-color:#00416d;'" id="name" class="block mt-1 w-full bg-blue-800 text-white" type="text" name="name" value="{{ $current_balance . ' HTG' }}" required disabled="true"/>
    </div>

</div>
