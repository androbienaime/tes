<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;

class CustomerTable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
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
            Column::make(__("Identity number"), "identity_number")
                ->sortable()
                ->searchable(),
        ];
    }
}
