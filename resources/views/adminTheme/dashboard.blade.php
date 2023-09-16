<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        if(Illuminate\Support\Facades\Gate::denies("isAdmin")){
            $rep = new \App\Http\Controllers\Admin\ReportController();
            $data = $rep->showDashEmployeeHistory(\App\Models\Employee::find(Auth::user()->id));

            $customer_count = $data["customer_count"];
            $sumDepositByDay = $data["sumDepositByDay"];
            $sumDepositByMonth = $data["sumDepositByMonth"];
            $sumWithdrawByDay = $data["sumWithdrawByDay"];
            $sumWithdrawByMonth = $data["sumWithdrawByMonth"];
            $sumReal = $data["sumReal"];
        }

    @endphp

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                        @include("adminTheme.partials.cards")

                        @can("access-settings")
                        <div class="grid gap-6 mb-6 md:grid-cols-2 p-4" >
                            <div class="bg-white shadow-md rounded p-2">
                                <div style="height: 24rem">
                                    <livewire:livewire-column-chart
                                        key="{{ $columnChartModel->reactiveKey() }}"
                                        :column-chart-model="$columnChartModel"
                                    />
                                </div>
                            </div>
                            <div class="bg-white shadow-md rounded p-2 w-full">
                                <livewire:livewire-pie-chart
                                    key="{{ $pieChartModel->reactiveKey() }}"
                                    :pie-chart-model="$pieChartModel"
                                />
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
