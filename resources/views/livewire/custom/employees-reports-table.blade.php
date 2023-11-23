{{--<div>--}}

{{--    <div class="container mx-auto w-full h-full">--}}
{{--        <div class="max-w-screen-lg mx-auto w-full h-full flex flex-col items-center justify-center">--}}
{{--            <div x-data="dataTable()"--}}
{{--                 x-init="--}}
{{--        initData()--}}
{{--        $watch('searchInput', value => {--}}
{{--          search(value)--}}
{{--        })" class="bg-white p-5 shadow-md w-full flex flex-col">--}}
{{--                <div class="flex justify-between items-center">--}}
{{--                    <div class="flex space-x-2 items-center mb-2">--}}
{{--                        <select x-model="view" @change="changeView()">--}}
{{--                            <option value="7">{{ __("Show") }}</option>--}}
{{--                            <option value="7">7</option>--}}
{{--                            <option value="15">15</option>--}}
{{--                            <option value="30">30</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <input x-model="searchInput" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="Search...">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <table class="min-w-full bg-white striped-tables">--}}
{{--                    <thead class="text-xs text-gray-700 text-center uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">--}}
{{--                    <th  class="w-1/3 text-center py-3 px-2 uppercase font-semibold text-sm">--}}
{{--                        <div class="flex space-x-2">--}}
{{--                  <span>--}}
{{--                    {{ __("DATE") }}--}}
{{--                  </span>--}}
{{--                            </span>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <svg @click="sort('transaction_date', 'asc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'transaction_date' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>--}}
{{--                                <svg @click="sort('transaction_date', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'transaction_date' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </th>--}}
{{--                    <th class="w-1/3 text-center py-3 px-2 uppercase font-semibold text-sm">--}}
{{--                        <div class="flex items-center space-x-2">--}}
{{--                  <span class="">--}}
{{--                    {{ __("DEPOSIT") }}--}}
{{--                  </span>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <svg @click="sort('deposit_sum', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'deposit_sum' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>--}}
{{--                                <svg @click="sort('deposit_sum', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'deposit_sum' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </th>--}}
{{--                    <th class="w-1/3 text-center py-3 px-2 uppercase font-semibold text-sm">--}}
{{--                        <div class="flex items-center space-x-2">--}}
{{--                  <span class="">--}}
{{--                    {{ __("WITHDRAWAL") }}--}}
{{--                  </span>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <svg @click="sort('withdrawal_sum', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'withdrawal_sum' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>--}}
{{--                                <svg @click="sort('withdrawal_sum', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'withdrawal_sum' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </th>--}}
{{--                    <th class="w-1/3 text-center py-3 px-2 uppercase font-semibold text-sm">--}}
{{--                        <div class="flex items-center space-x-2">--}}
{{--                  <span>--}}
{{--                    {{ __("PAYMENT") }}--}}
{{--                  </span>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <svg @click="sort('payment_sum', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'payment_sum' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>--}}
{{--                                <svg @click="sort('payment_sum', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'payment_sum' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </th>--}}

{{--                    <th class="w-1/3 text-center py-3 px-2 uppercase font-semibold text-sm">--}}
{{--                        <div class="flex items-center space-x-2">--}}
{{--                          <span>--}}
{{--                            {{ __("ACTION") }}--}}
{{--                          </span>--}}
{{--                        </div>--}}
{{--                    </th>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <template x-for="(item, index) in items" :key="index" class="striped-tables">--}}
{{--                        <tr x-show="checkView(index + 1)" class="text-gray-900 text-xs cursor-pointer">--}}
{{--                            <x-td-custom-table align="left">--}}
{{--                                <span x-text="formatDateToDmy(new Date(item.transaction_date)); "></span>--}}
{{--                            </x-td-custom-table>--}}
{{--                            <x-td-custom-table >--}}
{{--                                <span x-text="item.deposit_sum"></span>--}}
{{--                            </x-td-custom-table>--}}
{{--                            <x-td-custom-table>--}}
{{--                                <span x-text="item.withdrawal_sum"></span>--}}
{{--                            </x-td-custom-table>--}}
{{--                            <x-td-custom-table>--}}
{{--                                <span x-text="item.payment_sum"></span>--}}
{{--                            </x-td-custom-table>--}}
{{--                            <x-td-custom-table>--}}
{{--                                <form method="GET" x-bind:action="'{{ route("admin.employee.searchReportEmployees", "") }}/' + item.transaction_date">--}}
{{--                                    <x-primary-button>{{ __("Show") }}</x-primary-button>--}}
{{--                                </form>--}}
{{--                            </x-td-custom-table>--}}
{{--                        </tr>--}}
{{--                    </template>--}}
{{--                    <tr x-show="isEmpty()">--}}
{{--                        <td colspan="5" class="text-center py-3 text-gray-900 text-sm">{{ __("No matching records found.") }}</td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <div class="flex mt-5">--}}
{{--                    <div class="border px-2 cursor-pointer" @click.prevent="changePage(1)">--}}
{{--                        <span class="text-gray-700">{{ __("Previous") }}</span>--}}
{{--                    </div>--}}
{{--                    <div class="border px-2 cursor-pointer" @click="changePage(currentPage - 1)">--}}
{{--                        <span class="text-gray-700"><</span>--}}
{{--                    </div>--}}
{{--                    <template x-for="item in pages">--}}
{{--                        <div @click="changePage(item)" class="border px-2 cursor-pointer" x-bind:class="{ 'bg-gray-300': currentPage === item }">--}}
{{--                            <span class="text-gray-700" x-text="item"></span>--}}
{{--                        </div>--}}
{{--                    </template>--}}
{{--                    <div class="border px-2 cursor-pointer" @click="changePage(currentPage + 1)">--}}
{{--                        <span class="text-gray-700">></span>--}}
{{--                    </div>--}}
{{--                    <div class="border px-2 cursor-pointer" @click.prevent="changePage(pagination.lastPage)">--}}
{{--                        <span class="text-gray-700">{{ __("Next") }}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}
{{--    <script>--}}
{{--        let data = @json($data);--}}

{{--        window.dataTable = function () {--}}
{{--            return {--}}
{{--                items: [],--}}
{{--                view: 7,--}}
{{--                searchInput: '',--}}
{{--                pages: [],--}}
{{--                offset: 7,--}}
{{--                pagination: {--}}
{{--                    total: data.length,--}}
{{--                    lastPage: Math.ceil(data.length / 7),--}}
{{--                    perPage: 7,--}}
{{--                    currentPage: 1,--}}
{{--                    from: 1,--}}
{{--                    to: 1 * 7--}}
{{--                },--}}
{{--                currentPage: 1,--}}
{{--                sorted: {--}}
{{--                    field: 'transaction_date',--}}
{{--                    rule: 'desc'--}}
{{--                },--}}
{{--                initData() {--}}
{{--                    this.items = data.sort(this.compareOnKey('transaction_date', 'desc'))--}}
{{--                    this.showPages()--}}
{{--                },--}}
{{--                compareOnKey(key, rule) {--}}
{{--                    return function(a, b) {--}}
{{--                        if (key === 'deposit_sum' || key === 'withdrawal_sum' || key === 'payment_sum') {--}}
{{--                            let comparison = 0--}}
{{--                            const fieldA = a[key]--}}
{{--                            const fieldB = b[key]--}}

{{--                            if (rule === 'asc') {--}}
{{--                                if (fieldA > fieldB) {--}}
{{--                                    comparison = 1;--}}
{{--                                } else if (fieldA < fieldB) {--}}
{{--                                    comparison = -1;--}}
{{--                                }--}}
{{--                            } else {--}}
{{--                                if (fieldA < fieldB) {--}}
{{--                                    comparison = 1;--}}
{{--                                } else if (fieldA > fieldB) {--}}
{{--                                    comparison = -1;--}}
{{--                                }--}}
{{--                            }--}}
{{--                            return comparison--}}
{{--                        }else if(key === "transaction_date"){--}}
{{--                            const fieldA = new Date(a[key])--}}
{{--                            const fieldB = new Date(b[key])--}}
{{--                            console.log("FA : " + fieldA + " FB : " + fieldB);--}}
{{--                            let comparison =0;--}}

{{--                            if(rule === 'asc') {--}}
{{--                                if (fieldA > fieldB){--}}
{{--                                    comparison = 1;--}}
{{--                                }else if(fieldA < fieldB){--}}
{{--                                    comparison = -1;--}}
{{--                                }--}}
{{--                            }else{--}}
{{--                                if (fieldA < fieldB){--}}
{{--                                    comparison = 1;--}}
{{--                                }else if(fieldA > fieldB){--}}
{{--                                    comparison = -1;--}}
{{--                                }--}}
{{--                            }--}}

{{--                            return comparison;--}}
{{--                        } else {--}}
{{--                            if (rule === 'asc') {--}}
{{--                                // return a.transaction_date - b.transaction_date--}}
{{--                            } else {--}}
{{--                                // return b.transaction_date - a.transaction_date--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                },--}}
{{--                checkView(index) {--}}
{{--                    return index > this.pagination.to || index < this.pagination.from ? false : true--}}
{{--                },--}}
{{--                checkPage(item) {--}}
{{--                    if (item <= this.currentPage + 7) {--}}
{{--                        return true--}}
{{--                    }--}}
{{--                    return false--}}
{{--                },--}}
{{--                search(value) {--}}
{{--                    if (value.length > 1) {--}}
{{--                        const options = {--}}
{{--                            shouldSort: true,--}}
{{--                            keys: ['transaction_date'],--}}
{{--                            threshold: 0--}}
{{--                        }--}}
{{--                        const fuse = new Fuse(data, options)--}}
{{--                        this.items = fuse.search(value).map(elem => elem.item)--}}
{{--                    } else {--}}
{{--                        this.items = data--}}
{{--                    }--}}
{{--                    // console.log(this.items.length)--}}

{{--                    this.changePage(1)--}}
{{--                    this.showPages()--}}
{{--                },--}}
{{--                sort(field, rule) {--}}
{{--                    this.items = this.items.sort(this.compareOnKey(field, rule))--}}
{{--                    this.sorted.field = field--}}
{{--                    this.sorted.rule = rule--}}
{{--                },--}}
{{--                changePage(page) {--}}
{{--                    if (page >= 1 && page <= this.pagination.lastPage) {--}}
{{--                        this.currentPage = page--}}
{{--                        const total = this.items.length--}}
{{--                        const lastPage = Math.ceil(total / this.view) || 1--}}
{{--                        const from = (page - 1) * this.view + 1--}}
{{--                        let to = page * this.view--}}
{{--                        if (page === lastPage) {--}}
{{--                            to = total--}}
{{--                        }--}}
{{--                        this.pagination.total = total--}}
{{--                        this.pagination.lastPage = lastPage--}}
{{--                        this.pagination.perPage = this.view--}}
{{--                        this.pagination.currentPage = page--}}
{{--                        this.pagination.from = from--}}
{{--                        this.pagination.to = to--}}
{{--                        this.showPages()--}}
{{--                    }--}}
{{--                },--}}
{{--                showPages() {--}}
{{--                    const pages = []--}}
{{--                    let from = this.pagination.currentPage - Math.ceil(this.offset / 2)--}}
{{--                    if (from < 1) {--}}
{{--                        from = 1--}}
{{--                    }--}}
{{--                    let to = from + this.offset - 1--}}
{{--                    if (to > this.pagination.lastPage) {--}}
{{--                        to = this.pagination.lastPage--}}
{{--                    }--}}
{{--                    while (from <= to) {--}}
{{--                        pages.push(from)--}}
{{--                        from++--}}
{{--                    }--}}
{{--                    this.pages = pages--}}
{{--                },--}}
{{--                changeView() {--}}
{{--                    this.changePage(1)--}}
{{--                    this.showPages()--}}
{{--                },--}}
{{--                isEmpty() {--}}
{{--                    return this.pagination.total ? false : true--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--       function formatDateToDmy(date) {--}}
{{--           const options = {--}}
{{--               day: 'numeric',--}}
{{--               month: 'long',--}}
{{--               year: 'numeric',--}}
{{--               weekday: 'long',--}}
{{--               timeZone: 'UTC' // Spécifiez le fuseau horaire du serveur ici--}}
{{--           };--}}

{{--            // Formatez la date--}}
{{--          return date.toLocaleDateString('fr-FR', options);--}}
{{--        }--}}
{{--    </script>--}}

{{--    <style>--}}
{{--        .striped-tables tr:nth-child(odd) {--}}
{{--            background-color: #F2F2F2; /* Couleur de fond pour les lignes paires */--}}
{{--        }--}}
{{--    </style>--}}
{{--</div>--}}

<div class="p-5">
    <x-custom-table class="striped-tables {{ $loading ? 'opaque' : '' }}"
        :td_head="['DATE', __('DEPOSIT'), __('WITHDRAWAL'), __('PAYMENT'), __('ACTION')]">
        @foreach($datas as $data)

            <tr class="p-2 ">
                <x-td-custom-table class="uppercase" align="left">
                    {{ App\Models\Transaction::formatDateToDmy($data->transaction_date) }}
                </x-td-custom-table>
                <x-td-custom-table class="">
                    {{ $data->deposit_sum }}
                </x-td-custom-table>

                <x-td-custom-table>
                    {{ $data->withdrawal_sum }}
                </x-td-custom-table>

                <x-td-custom-table >
                    {{ $data->payment_sum }}
                </x-td-custom-table>

                <x-td-custom-table>
                    <form method="GET" action="{{ route("admin.employee.searchReportEmployees", $data->transaction_date) }}" >
                        <x-primary-button>{{ __("Show") }}</x-primary-button>
                    </form>
                </x-td-custom-table>
            </tr>
        @endforeach
    </x-custom-table>
    <div class="py-2">
        {{ $datas->links() }}
    </div>
    <style>
        .striped-tables tr:nth-child(even) {
            background-color: #F2F2F2; /* Couleur de fond pour les lignes paires */
        }
        .opaque{
            opacity: 0.6;
            transition: opacity 0.9s ease;
        }
    </style>
</div>
