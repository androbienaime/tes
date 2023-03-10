<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Employee;
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
        $classes = "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex
        items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";

        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("First name", "firstname")
                ->sortable(),
            Column::make("Last name", "lastname")
                ->sortable(),
            Column::make("Gender", "gender")
                ->sortable(),
            Column::make("First name", "firstname")
                ->sortable(),
            Column::make("Branch", "branch.name")
                ->searchable()
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')
                ->location(fn($row) => route('admin.employee.edit', $row->id))
                ->attributes(fn($row) => [
                    'class' => $classes
                ]),
        ];
    }
}
