<x-admin-layout>
    @php $t = new \App\Models\Transaction(); @endphp
    <div class="max-w-7xl sm:px-6 ">
        <div class="p-2 text-center mb-2">
        </div>
        <div class="mb-10 bg-white shadow-sm md:max-w-screen-lg lg:md:max-w-screen-lg p-4">
        <x-html-print>
            <div class="p-2 text-center mb-1">
                <p> <span class="text-2xl text-blue-600 uppercase">{{ __("Rapport / ").\Carbon\Carbon::now()->format('Y-m-d')  }} </span></p>

                <p><span class="text-1xl text-blue-600 uppercase">{{ $branch->name }}</span></p>
                <hr class="mb-2 h-5"/>
            </div>
            <div class="m-5 overflow-auto">
                <x-custom-table class="striped-tables"
                                :td_head="['DATE', 'CODE', __('Amount'), 'DESCRIPTION', 'EMPLOYEE']">


                    @foreach($details as $detail)
                        <tr>
                            <x-td-custom-table>{{ $detail['created_at'] }}</x-td-custom-table>
                            <x-td-custom-table>{{ $detail['code'] }}</x-td-custom-table>
                            <x-td-custom-table>{{ $detail['amount'] }}</x-td-custom-table>
                            <x-td-custom-table>{{ __($detail['description']) }}</x-td-custom-table>
                            <x-td-custom-table>{{ $detail['employee'] }}</x-td-custom-table>
                        </tr>
                    @endforeach
                </x-custom-table>
            </div>
        </x-html-print>
        </div>
    </div>

</x-admin-layout>
