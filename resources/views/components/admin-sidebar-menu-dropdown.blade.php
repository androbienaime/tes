@props(['iconLeft', 'titles'])

<div x-data="{open : false, toggle() { open: true } }">
    <!-- Menu DropDown -->
    <div @click="open = !open" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300
                        cursor-pointer hover:bg-blue-600 text-white" >
        <i {{ $attributes->merge(['class' => $iconLeft]) }} ></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-gray-200">{{ __($titles) }}</span>
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </div>

    <!-- SubMenu -->
    <div x-show="open" class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="dropdown-example">
        {{ $slot }}
    </div>
</div>
