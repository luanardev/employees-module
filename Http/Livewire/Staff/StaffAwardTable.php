<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Luanardev\Modules\Employees\Entities\Staff;


class StaffAwardTable extends DataTableComponent
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
		return $this->emit('create-award') ;
	}

    public function editAction()
	{
		if(count($this->selectedKeys)){
			$key = collect($this->selectedKeys)->first();
			return $this->emit('edit-award', $key) ;
		}
	}

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('delete-award', $this->selectedKeys) ;
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
			Column::make('Award', 'name'),
			Column::make('Institution', 'institution'),
			Column::make('Country', 'country'),
			Column::make('Year', 'year'),
		];
	}

	public function query()
	{
		return $this->staff->awards()->orderby('year', 'desc');
	}


}
