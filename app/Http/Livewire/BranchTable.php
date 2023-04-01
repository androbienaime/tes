<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
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
            Column::make("ID", "id")
                ->sortable()
                ->hideIf(true),
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
            ButtonGroupColumn::make("Action", 'id')
                ->buttons([
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.branch.show.history', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'bi bi-eye-fill text-blue-600 hover:text-gray-800'
                            ];
                        }),
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.branch.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-pencil-square text-blue-600 hover:text-gray-800'
                            ];
                        }),
                ]),

        ];
    }
}
