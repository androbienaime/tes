<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Employee;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EmployeeTable extends DataTableComponent
{
    protected $model = Employee::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make(__("First name"), "firstname")
                ->sortable()
                ->searchable(),
            Column::make(__("Last name"), "lastname")
                ->sortable()
                ->searchable(),
            Column::make(__("Email"), "user.email")
                ->sortable()
                ->searchable(),
            Column::make(__("Nick name"), "user.name")
                ->sortable(),
            Column::make(__("Gender"), "gender")
                ->sortable(),
            Column::make(__("Branch"), "branch.name")
                ->searchable()
                ->sortable(),
            ButtonGroupColumn::make("Action", 'id')
                ->buttons([
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.employee.show.history', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'bi bi-eye-fill text-blue-600 hover:text-gray-800'
                            ];
                        }),
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.employee.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-pencil-square text-blue-600 hover:text-gray-800'
                            ];
                        }),
                    LinkColumn::make('') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('admin.employee.beforedestroy', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'px-2 bi bi-trash3 text-red-600 hover:text-gray-800'
                            ];
                        }),
                ]),
        ];
    }
}
