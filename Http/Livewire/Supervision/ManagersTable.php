<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Supervision;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Luanardev\Modules\Employees\Entities\Managership;
use Luanardev\Modules\Employees\Entities\ManagershipView;
use Luanardev\LivewireAlert\WithLivewireAlert;

class ManagersTable extends DataTableComponent
{
	use WithLivewireAlert;

	public array $perPageAccepted = [10, 20, 50, 100, 200, 500];

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

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			foreach($this->selectedKeys as $key){
				Managership::getStaff($key)->delete();
			}			
			$this->emit('refresh');
			$this->toastr('Operation successful');
		}
	}

	public function bulkActions(): array
	{
		return [
			'deleteAction' => 'Delete'
		];
	}
	

	public function columns(): array
	{
		return [
			Column::make('ID', 'id'),
			Column::make('Title'),
			Column::make('Name'),
			Column::make('Position'),
			Column::make('Section'),
			Column::make('Campus'),
		];
	}

	public function query(): Builder
	{
		return ManagershipView::getByCampus()
			->when($this->getFilter('search'),
				fn ($query, $term) => $query->search($term)
        );
	}

}
