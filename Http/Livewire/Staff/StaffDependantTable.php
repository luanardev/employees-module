<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Luanardev\Modules\Employees\Entities\Staff;


class StaffDependantTable extends DataTableComponent
{

	public Staff $staff;

	public bool $showSearch = false;

	public bool $showPerPage = false;

	public function mount(Staff $staff)
	{
		$this->staff = $staff;
	}

	public function createAction()
	{
		return $this->emit('create-dependant') ;
	}

    public function editAction()
	{
		if(count($this->selectedKeys)){
			$key = collect($this->selectedKeys)->first();
			return $this->emit('edit-dependant', $key) ;
		}
	}

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('delete-dependant', $this->selectedKeys) ;
		}
    }

    public function rowView(): string
	{
		return 'employees::livewire.staff.dependant.table-row';
	}

	public function getListeners()
    {
        return [
            'refresh' => '$refresh',
        ];
    }

	public function bulkActions(): array
	{
		return [
			'createAction'  =>  'Create',
			'editAction'    =>  'Edit',
			'deleteAction'	=>	'Delete'
		];
	}

	public function columns(): array
	{
		return [
			Column::make('Name'),
			Column::make('Birthday'),
			Column::make('Gender'),
			Column::make('Relation'),
		];
	}

	public function query()
	{
		return $this->staff->dependants();
	}


}
