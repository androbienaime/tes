<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Transaction;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TransactionTable extends DataTableComponent
{
    protected $model = Transaction::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('CREATED_AT', 'desc');
        $this->setFooterEnabled();

        if(!Gate::denies("access-settings")) {
            $this->setBulkActions([
                'exportSelected' => 'Export',
            ]);
        }


    }

    public function filters(): array
    {
        if(Gate::denies("access-settings")) {
            return [];
        }
            return [
                SelectFilter::make('Active')
                    ->options([
                        '' => 'All',
                        'yes' => 'Yes',
                        'no' => 'No',
                    ]),

                DateFilter::make('Verified From')
                    ->config([
                        'min' => '2023-01-01',
                    ]),

                NumberFilter::make('Amount')
                    ->config([
                        'min' => 0,
                    ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->where('amount', '>', $value);
                    }),
            ];

    }

    public function columns(): array
    {
        $classes = "text-white bg-red-600 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex
        items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";

        return [
            Column::make("Id", "id")
                ->sortable()
                ->hideIf(true),
            Column::make("Account id", "account_id")
                ->sortable()
                ->hideIf(true),
            Column::make(__("CUSTOMER NAME"), "account.customer.name")
                ->sortable()
                ->searchable(),
            Column::make(__("CUSTOMER FIRSTNAME"), "account.customer.firstname")
                ->sortable()
                ->searchable(),
            Column::make(__("ID TRANSACTION"), "code")
                ->sortable(),
            Column::make(__("Amount / HTG"), "amount")
                ->sortable(),
            Column::make(__("Employee"), "employee.firstname")
                ->sortable()
                ->hideIf(Gate::denies("access-settings")),
            Column::make(__("Type of transaction"), "type_of_transaction.name")
                ->sortable(),

            Column::make(__("Created at"), "created_at")
                ->sortable(),
            Column::make(__("Updated at"), "updated_at")
                ->sortable(),
            LinkColumn::make("Action")
                ->hideIf(Gate::denies("access-update-customer"))
                ->title(fn($row) => 'Delete')
                ->location(fn($row) => route('admin.transaction.edit', $row))
                ->attributes(fn($row) => [
                        'class' => $classes
            ])
        ];
    }
}
