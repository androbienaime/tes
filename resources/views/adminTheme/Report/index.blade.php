@can("access-settings")

<x-admin-layout>
    @php $reportController = new \App\Http\Controllers\Admin\ReportController(); @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex items-center bg-gray-100 dark:bg-gray-900">
                        <div class="container max-w-6xl px-5 mx-auto my-5">
                            <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
                                <x-admin-card :icon_class="'bi bi-people-fill'"
                                                  :title="__('Branch Save')" :qty="$branch_count"/>

                                @foreach($all_branch as $branch)
                                    <a href="{{ route("admin.report.showReportDetailedBranch", $branch) }}">
                                        <x-admin-card :icon_class="'bi bi-people-fill'" :sub_title="'Montant Dispo'"
                                                  :title="__($branch->name)" :qty="$reportController->getBranchHistory($branch)['sum_real']"
                                                      class="hover:bg-gray-50"
                                        />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            <div class="">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5 bg-white my-5">
                    <div class="p-2 text-center">
                        <p> <span class="text-2xl text-blue-600 uppercase">{{ "LT FINANCE ".__("Report") }} </span></p>

                        <p><span class="text-1xl text-blue-600 uppercase">{{ $date }}</span></p>
                        <hr class="mb-2 h-5"/>
                    </div>
                    <x-custom-table
                        :td_head="['NOM', 'DEPOT / GOURDES', 'RETRAIT / GOURDES', 'MONTANT DISPO', 'LIVRET']">
                        @php $i=0; @endphp
                        @foreach($employeeDataList as $employee)

                            <tr class="p-2 @if($i%2 == 1) bg-gray-100 @endif">

                                <x-td-custom-table class="uppercase" align="left">
                                    {{ $employee['firstname'] . " " . $employee['name'] }}
                                </x-td-custom-table>
                                <x-td-custom-table class="">
                                    {{ $employee['deposit_sum']}}
                                </x-td-custom-table>

                                <x-td-custom-table>
                                    {{ $employee['withdraw_sum']}}
                                </x-td-custom-table>

                                <x-td-custom-table >
                                    {{ $employee['sum_real'] }}
                                </x-td-custom-table>

                                <x-td-custom-table>
                                    {{ $employee['accountRegistredByDayAndEmployee'] }}
                                </x-td-custom-table>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                        <tr>
                            <x-td-custom-table class="bg-gray-900 text-white">Total </x-td-custom-table>
                            <x-td-custom-table class="bg-gray-900 text-white">
                                {{ $totals['deposit_sum'] }}
                            </x-td-custom-table>

                            <x-td-custom-table class="bg-gray-900 text-white">
                                {{ $totals['withdraw_sum'] }}
                            </x-td-custom-table>

                            <x-td-custom-table class="bg-gray-900 text-white">
                                {{ $totals["sum_real"] }}
                            </x-td-custom-table>

                            <x-td-custom-table class="bg-gray-900 text-white">
                                {{ $totals['accountRegistredByDayAndEmployee'] }}
                            </x-td-custom-table>
                        </tr>
                    </x-custom-table>
                </div>
            </div>
            <div class="bg-white">
                <div class="p-2 text-center mb-2">
                    <p> <span class="text-2xl text-blue-600 uppercase">{{ __("Employee Report/Day") }} </span></p>
                    <hr />
                </div>
                <livewire:custom.employees-reports-table />
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</x-admin-layout>
@endcan
