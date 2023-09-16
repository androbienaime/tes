<div>
    @php
        $classes = "block w-full z-20 text-sm text-gray-900
                    bg-gray-50 rounded-r-lg border-l-gray-50
                    border-l-2 border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700
                    dark:border-l-gray-700  dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-
                    white dark:focus:border-blue-500";
        $classes1 = "flex-shrink-0 z-10 inline-flex items-center
                    py-3  text-sm font-medium text-center
                    text-gray-900 bg-gray-100 border
                    border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4
                    focus:outline-none focus:ring-gray-100 dark:bg-gray-700
                    dark:hover:bg-gray-600 dark:focus:ring-gray-700
                    dark:text-white dark:border-gray-600 ";
    @endphp
    <script>
        function intCodesComponent() {
            return {
                intCodes: [
                    {
                        name: "United States",
                        dial_code: "+1",
                        code: "KR",
                        format: '(999) 999-9999'
                    },
                    {
                        name: "Haiti",
                        dial_code: "+509",
                        code: "HT",
                        format: '99 99 9999'
                    }
                ],
                selectedDialCode: '+509',
                selectedFormat: '99 99 9999',
                onSelectChangeHandler(e) {
                    const country = intCodes.find((element) => {
                        return element.dial_code == this.selectedDialCode
                    })

                    this.selectedFormat = country.format
                },
            }
        }
    </script>
    <div x-data="intCodesComponent" x-init="intCodes = window.intCodes"
         class="appearance-none block flex w-full
     text-gray-700

    focus:outline-none focus:bg-white">
        <select id="countries" class="{{ $classes1 }}" x-model="selectedDialCode" @change="onSelectChangeHandler">
            <template x-for="{dial_code} in intCodes">
                <option :value="dial_code" x-text="dial_code" :selected="dial_code == '+509'"></option>
            </template>
        </select>
        <input x-mask:dynamic="selectedFormat" type="text" {!! $attributes->merge(['class' => $classes ]) !!} name="{{ $names }}" autocomplete="off" :placeholder="selectedFormat">
    </div>
</div>

<script>
    window.intCodes = [
        {
            name: "United States",
            dial_code: "+1",
            code: "KR",
            format: '(999) 999-9999'
        },
        {
            name: "Haiti",
            dial_code: "+509",
            code: "HT",
            format: '99 99 9999'
        }
    ];
</script>
