<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Account;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class AccountTable extends DataTableComponent
{
    protected $model = Account::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make("Full Name", "Customer.firstname")
                ->format(
                    fn($value, $row, Column $column) => $row->firstname
                )
                ->sortable(),
            Column::make("Balance", "balance")
                ->sortable(),
            BooleanColumn::make('Active', "state")
                ->view("adminTheme.Account.partials.state-view"),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
