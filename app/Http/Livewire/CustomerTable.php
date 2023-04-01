<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class CustomerTable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('customers.created_at', 'desc');

        $this->setPerPageAccepted([10, 25, 50, 100]);

    }

    public function columns(): array
    {
        $classes = "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex
        items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";

        return [
            Column::make(__("ID"), "id")
                ->sortable()
                ->hideIf(true),
            Column::make(__("Code"), "code")
                ->sortable()
                ->searchable(),
            Column::make(__("Name"), "name")
                ->sortable()
                ->searchable(),
            Column::make(__("First name"), "firstname")
                ->sortable()
                ->searchable(),
            Column::make(__("Gender"), "gender")
                ->sortable(),
            Column::make(__("phone"), "address.phone")
                ->sortable()
                ->searchable(),
            Column::make(__("Identity number"), "identity_number")
                ->sortable()
                ->searchable(),
            Column::make(__("City"), "address.city")
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make("Action", 'id')
                ->buttons([
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.customer.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-pencil-square text-blue-600 hover:text-gray-800'
                            ];
                        }),
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.account.show', $row))
                        ->attributes(function($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'px-2 bi bi-trash3 text-red-600 hover:text-gray-800'
                            ];
                        }),
                ]),
        ];
    }
}
