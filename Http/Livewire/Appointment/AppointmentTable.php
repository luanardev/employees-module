<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Appointment;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Luanardev\Modules\Employees\Entities\StaffView;

class AppointmentTable extends DataTableComponent
{

	public array $perPageAccepted = [10, 20, 50, 100, 200, 500];

	public bool $columnSelect = true;

	public function getTableRowUrl($row): string
	{
		return route('staff.show', $row);
	}

	public function getListeners()
    {
        return [
            'refresh' => '$refresh',
        ];
    }

	public function columns(): array
	{
		return [
			Column::make('ID', 'id')->excludeFromSelectable()->sortable(),
			Column::make('Title')->excludeFromSelectable()->sortable(),
			Column::make('Fullname')->excludeFromSelectable()->sortable(),
			Column::make('Position')->excludeFromSelectable(),
			Column::make('Section'),
			Column::make('Department'),
			Column::make('Campus'),
		];
	}

	public function query(): Builder
	{
		return StaffView::getByCampus()->where('appointed', 'Yes')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term) );
	}

}
