<div>
    <div class="flex flex-col items-center">
        <div class="w-full md:w-1/2 flex flex-col items-center">
            <div class="w-full px-4">
                <div x-data="selectConfigs()" x-init="" class="flex flex-col items-center relative">
                    <div class="w-full">
                        <input type="hidden" name="id" x-model="code_f" />
                        <x-label-admin :required="true" for="nameofcustomer">{{ __("Client name") }}</x-label-admin>

                        <div @click.away="close()" class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                            <input
                                x-model="filter"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                @keyup="fetchOptions()"
                                @mousedown="open()"
                                @keydown.enter.stop.prevent="selectOption()"
                                @keydown.arrow-up.prevent="focusPrevOption()"
                                @keydown.arrow-down.prevent="focusNextOption()"
                                class="p-1 px-2 appearance-none outline-none w-full text-gray-800 "
                                placeholder="{{ __('Find a customer..') }}">
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
                            <template x-for="(option, index) in filteredOptions()" :key="index">
                                <div @click="onOptionClick(index)" :class="classOption(option.id, index)" :aria-selected="focusedOptionIndex === index">
                                    <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                        <div class="w-6 flex flex-col items-center">
                                            <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full "> </div>
                                        </div>
                                        <div class="w-full items-center flex">
                                            <div x-show="option.firstname.length > 0" class="mx-2 -mt-1"><span x-text="option.firstname + ' ' + option.name"></span>
                                                <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500" x-text="'Phone : ' + option.phone"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                        </div>

                    </div>
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />

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
            const optionsUrl = '/admin/api/getcustomers';
            const filterMinLength = 2;

            return {
                filter: '',
                show: false,
                selected: null,
                focusedOptionIndex: null,
                options: null,
                code_f: null,

                open() {
                    this.show = true;
                    this.filter = '';
                },

                close() {
                    this.show = false;
                    this.filter = this.selectedName();
                    this.focusedOptionIndex = this.selected?.focusedOptionIndex;
                },

                toggle() {
                    this.show ? this.close() : this.open();
                },

                isOpen() {
                    return this.show;
                },

                selectedName() {
                    return this.selected ? `${this.selected.firstname} ${this.selected.name}` : this.filter;
                },

                classOption(id, index) {
                    const isSelected = this.selected?.id === id;
                    const isFocused = index === this.focusedOptionIndex;
                    return {
                        'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50': true,
                        'bg-blue-100': isSelected,
                        'bg-blue-50': isFocused,
                    };
                },

                async fetchOptions() {
                    if (this.filter.length >= filterMinLength) {
                        try {
                            const response = await fetch(`${optionsUrl}?search=${this.filter}`);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            const data = await response.json();
                            if (Array.isArray(data)) {
                                this.options = data;
                            } else {
                                throw new Error('Invalid data format');
                            }
                        } catch (error) {
                            console.error('Error fetching options:', error);
                        }
                    }
                },

                filteredOptions() {
                    return this.options?.filter(option => {
                        return option.name.toLowerCase().includes(this.filter.toLowerCase())
                            || option.firstname.toLowerCase().includes(this.filter.toLowerCase())
                            || option.email.toLowerCase().includes(this.filter.toLowerCase());
                    }) ?? [];
                },

                onOptionClick(index) {
                    this.focusedOptionIndex = index;
                    this.selectOption();
                },

                selectOption() {
                    if (!this.isOpen()) {
                        return;
                    }
                    this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                    const selected = this.filteredOptions()[this.focusedOptionIndex];
                    if (this.selected && this.selected.id === selected.id) {
                        this.filter = '';
                        this.selected = null;
                    } else {
                        this.selected = selected;
                        this.filter = this.selectedName();
                        this.code_f = this.selected.id;
                    }
                    this.close();
                },

                focusPrevOption() {
                    if (!this.isOpen()) {
                        return;
                    }
                    const optionsNum = this.filteredOptions().length - 1;
                    if (this.focusedOptionIndex > 0 && this.focusedOptionIndex <= optionsNum) {
                        this.focusedOptionIndex--;
                    } else if (this.focusedOptionIndex === 0) {
                        this.focusedOptionIndex = optionsNum;
                    }
                },
                focusNextOption() {
                    const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                    if (!this.isOpen()) {
                        this.open();
                    }
                    if (this.focusedOptionIndex == null || this.focusedOptionIndex == optionsNum) {
                        this.focusedOptionIndex = 0;
                    }
                    else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                        this.focusedOptionIndex++;
                    }
                }
            }
        }
    </script>
</div>
