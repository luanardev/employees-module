<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Luanardev\Modules\Employees\Entities\Employee;


class StaffQualificationTable extends DataTableComponent
{

	public Employee $employee;

	public bool $showSearch = false;

	public bool $showPerPage = false;

	public function mount(Employee $employee)
	{
		$this->employee = $employee;
	}

	public function createAction()
	{
		return $this->emit('create-qualification') ;
	}

    public function editAction()
	{
		if(count($this->selectedKeys)){
			$key = collect($this->selectedKeys)->first();
			return $this->emit('edit-qualification', $key) ;
		}
	}

	public function setHighest()
	{
		if(count($this->selectedKeys)){
			$key = collect($this->selectedKeys)->first();
			return $this->emit('set-highest', $key) ;
		}
	}

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('delete-qualification', $this->selectedKeys) ;
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
			'setHighest'	=>	'Set Highest',
		];
	}

	public function columns(): array
	{
		return [
			Column::make('Qualification', 'name'),
			Column::make('Level', 'qualificationLevel.name'),
			Column::make('Specialization', 'specialization'),
			Column::make('Institution', 'institution'),
			Column::make('Country', 'country'),
			Column::make('Year', 'year'),
		];
	}

	public function query()
	{
		return $this->employee->qualifications()->orderby('year', 'desc');
	}


}
