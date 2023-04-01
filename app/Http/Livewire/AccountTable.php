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
            Column::make("Code", "code")
                ->sortable()
                ->searchable(),
            Column::make("Type of account", "type_of_account.name")
                ->sortable()
                ->searchable(),
            Column::make("Name", "Customer.name")
                ->sortable()
                ->searchable(),
            Column::make("Firstname", "Customer.firstname")
                ->searchable()
                ->sortable(),
            Column::make("Balance", "balance")
                ->sortable(),
            BooleanColumn::make('Active', "state")
                ->view("adminTheme.Account.livewire.btn.state-view"),
            Column::make("Employee", "Customer.Employee.firstname")
                ->sortable()
                ->hideIf(Gate::denies("isAdmin"))
                ->searchable(),
            ButtonGroupColumn::make("Action", 'id')
                ->buttons([
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.account.show.history', $row))
                        ->attributes(function($row) {
                            return [
                                'target' => '_blank',
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
