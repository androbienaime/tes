<div>
    <div class="flex flex-col items-center">
        <div class="w-full md:w-1/2 flex flex-col items-center ">
            <div class="w-full px-4">
                <div x-data="selectConfigs()" x-init="input_var()" class="flex flex-col items-center relative">
                    <div class="w-full">
                        <x-label-admin for="nameofcustomer">{{ __("Name of Customer") }}</x-label-admin>

                        <div @click.away="close()" class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                            <input
                                wire:model="filter"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                x-cloak
                                @mousedown="open()" x-text="input_name" placeholder="Search a customer......"
                                class="p-1 px-1 appearance-none outline-none w-full text-gray-800">
                            <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                                <button @click="toggle()" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline x-show="!isOpen()" points="18 15 12 20 6 15"></polyline>
                                        <polyline x-show="isOpen()" points="18 15 12 9 6 15"></polyline>
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>
                    <div x-show="isOpen()" class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                        <div class="flex flex-col w-full">
                            @if(count($customers) > 0)
                                @foreach($customers as $customer)
                            <div :customer="{{ $customer->name }} "@click="input_var(1, {{ $customer->name }})" class="flex w-full items-center cursor-pointer p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                <div class="w-6 flex flex-col items-center">
                                    <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full "><img class="rounded-full"> </div>
                                </div>
                                <div class="w-full items-center flex">
                                    <div class="mx-2 -mt-1">
                                        <span > {{ $customer->name.' '.$customer->firstname}}</span>
                                        <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500" > {{ $customer->firstname }}</div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .top-100 {top: 100%}
        .bottom-100 {bottom: 100%}
        .max-h-select {
            max-height: 300px;
        }
    </style>

    <script type="text/javascript">
        function selectConfigs() {
            return {
                filter: '',
                show: false,
                options: null,
                input_var: null,
                input_name:'',
                open() {
                    this.show = true;
                    this.filter = '';
                },
                close() {
                    this.show = false;
                },
                toggle() {
                    if (this.show) {
                        this.close();
                    }
                    else {
                        this.open()
                    }
                },
                isOpen() { return this.show === true },

            }
        }
    </script>
</div>
