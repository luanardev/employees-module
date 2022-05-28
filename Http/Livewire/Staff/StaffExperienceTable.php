<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Luanardev\Modules\Employees\Entities\Staff;


class StaffExperienceTable extends DataTableComponent
{

	public Staff $staff;

	public bool $showSearch = false;

	public bool $showPerPage = false;

	public function mount(Staff $staff)
	{
		$this->staff = $staff;
	}
    
    public function rowView(): string
	{
		return 'employees::livewire.staff.experience.table-row';
	}

	public function createAction()
	{
		return $this->emit('create-experience') ;
	}

    public function editAction()
	{
		if(count($this->selectedKeys)){
			$key = collect($this->selectedKeys)->first();
			return $this->emit('edit-experience', $key) ;
		}
	}

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('delete-experience', $this->selectedKeys) ;
		}
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
			'deleteAction'	=>	'Delete',
		];
	}

	public function columns(): array
	{
		return [
            Column::make('Position'),
			Column::make('Employer'),			
			Column::make('Address'),
			Column::make('Phone'),
			Column::make('Start Date'),
			Column::make('End Date'),
			Column::make('Work Period'),
		];
	}

	public function query()
	{
		return $this->staff->experience()->orderby('start_date', 'desc');
	}


}
