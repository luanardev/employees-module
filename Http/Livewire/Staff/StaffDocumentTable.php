<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Luanardev\Modules\Employees\Entities\Employee;


class StaffDocumentTable extends DataTableComponent
{

	public Employee $employee;

	public bool $showSearch = false;

	public bool $showPerPage = false;

	public function mount(Employee $employee)
	{
		$this->employee = $employee;
	}

    public function rowView(): string
	{
		return 'employees::livewire.staff.document.table-row';
	}

	public function createAction()
	{
		return $this->emit('create-document') ;
	}

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('delete-document', $this->selectedKeys) ;
		}
	}

    public function downloadAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('download-document', $this->selectedKeys) ;
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
			'deleteAction'	=>	'Delete',
			'downloadAction'=>	'Download',
		];
	}

	public function columns(): array
	{
		return [
			Column::make('Name', 'name'),
			Column::make('Type', 'type.name'),
			Column::make('Size', 'size'),
			Column::make('Mime', 'mime'),
		];
	}

	public function query()
	{
		return $this->employee->documents()->latest();
	}


}
