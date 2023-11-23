<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Account;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class AccountTable extends DataTableComponent
{
    protected $model = Account::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('accounts.created_at', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("No Account"), "code")
                ->sortable()
                ->searchable(),
            Column::make(__("Type of account"), "type_of_account.name")
                ->sortable()
                ->searchable(),
            Column::make(__("Full Name"))
                ->sortable()
                ->searchable()
                ->label(function ($row){
                    return $row['Customer.name']. " " .$row['Customer.firstname'];
                }),
            Column::make(__("Name"), "Customer.name")
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make(__("Firstname"), "Customer.firstname")
                ->searchable()
                ->sortable()
                ->hideIf(true),
            Column::make(__("Balance / HTG"), "balance")
                ->sortable(),
            Column::make(__("Phone"), "Customer.address.phone")
                ->searchable()
                ->sortable(),
            BooleanColumn::make(__('Active'), "state")
                ->view("adminTheme.Account.livewire.btn.state-view"),
            Column::make(__("Employee"), "Customer.Employee.firstname")
                ->sortable()
                ->hideIf(Gate::denies("isAdmin"))
                ->searchable(),
            Column::make(__("Created at"), "created_at")
                ->sortable(),
            ButtonGroupColumn::make("Action", 'id')
                ->buttons([
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.account.show.history', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'bi bi-eye-fill text-blue-600 hover:text-gray-800'
                            ];
                        }),
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.account.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-pencil-square text-blue-600 hover:text-gray-800'
                            ];
                        }),
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.account.edit', $row))
                        ->hideIf(Gate::denies("isAdmin"))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-trash3 text-red-600 hover:text-gray-800'
                            ];
                        }),
                ]),
        ];
    }
}
