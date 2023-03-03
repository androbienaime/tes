<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class BranchTable extends DataTableComponent
{
    protected $model = Branch::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(true);

    }

    public function columns(): array
    {
        $classes = "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex
        items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";


        return [
            Column::make("Code", "code")
                ->sortable(),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("State", "address.state")
                ->sortable(),
            Column::make("City", "address.city")
                ->sortable(),
            Column::make("Phone", "address.phone")
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')
                ->location(fn($row) => route('dashboard', $row))
                ->attributes(fn($row) => [
                    'class' => $classes
                ]),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Delete')
                ->location(fn($row) => route('dashboard', $row))
                ->attributes(fn($row) => [
                    'class' => $classes
                ]),
        ];
    }
}
