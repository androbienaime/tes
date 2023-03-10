<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Address;

class AddressTable extends DataTableComponent
{
    protected $model = Address::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setCollapsingColumnsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("City", "city")
                ->sortable(),
            Column::make("Country", "country")
                ->sortable(),
            Column::make("State", "state")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Address1", "address1")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
