@props(['names'])

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
        function intCodesComponentID() {
            return {
                intCodesID: [
                    {
                        name: "NIU",
                        dial_code: "NIU",
                        code: "NIU",
                        format: '9999999999'
                    },
                    {
                        name: "NIF",
                        dial_code: "NIF",
                        code: "NIF",
                        format: '999-999-999-9'
                    }
                ],
                selectedDialCodeID: 'NIU',
                selectedFormatID: '9999999999',
                onSelectChangeHandler(e) {
                    const country = intCodesID.find((element) => {
                        return element.dial_code == this.selectedDialCodeID
                    })

                    this.selectedFormatID = country.format
                },
            }
        }
    </script>
    <div x-data="intCodesComponentID" x-init="intCodesID = window.intCodesID"
         class="appearance-none block flex w-full
     text-gray-700

    focus:outline-none focus:bg-white">
        <select id="countries" class="{{ $classes1 }}" x-model="selectedDialCodeID" @change="onSelectChangeHandler">
            <template x-for="{dial_code} in intCodesID">
                <option :value="dial_code" x-text="dial_code" :selected="dial_code == 'NIU'"></option>
            </template>
        </select>
        <input x-mask:dynamic="selectedFormatID" type="text" class="{{ $classes }}" name="{{ $names }}" :placeholder="selectedFormatID">
    </div>
</div>

<script>
    window.intCodesID = [
        {
            name: "NIU",
            dial_code: "NIU",
            code: "NIU",
            format: '9999999999'
        },
        {
            name: "NIF",
            dial_code: "NIF",
            code: "NIF",
            format: '999-999-999-9'
        }
    ];
</script>
