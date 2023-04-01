<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report of Employee') }}
            :
            <span class="text-blue-500">
                {{ strtoupper($branch->name) }} GGGGDG
            </span>
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    @can("access-settings")
                        @include("adminTheme.partials.cards")

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
