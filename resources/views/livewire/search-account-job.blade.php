<div>

    <!-- Name -->
    <div class="mb-6 ">
        <x-input-label for="code" :value="__('Code Customer')" />
        <x-text-input id="code" wire:model="query" class="block mt-1 w-full" type="text" name="code" required/>
        <x-input-error :messages="$errors->get('code')" class="mt-2" />
    </div>

    <!-- Name -->
    <div class="mb-6 ">
        <x-input-label for="name" :value="__('Full Name')" />
        <x-text-input id="name" class="block mt-1 w-full {{ $classes }} " type="text" name="name" value="{{ $customer }}" required disabled="true"/>
    </div>
</div>
