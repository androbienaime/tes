<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TypeOfAccount;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TypeOfAccountTable extends DataTableComponent
{
    protected $model = TypeOfAccount::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Duration", "duration")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            ButtonGroupColumn::make("Action", 'id')
                ->buttons([
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.typeofaccountedit.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-pencil-square text-blue-600 hover:text-gray-800'
                            ];
                        }),
                ]),
        ];
    }
}
