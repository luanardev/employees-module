<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Luanardev\Modules\Employees\Entities\Grade;


class GradeTable extends DataTableComponent
{

    public array $perPageAccepted = [10, 20, 50];
    
	public function createAction()
	{
		return $this->emit('create-grade');
	}

    public function editAction()
	{
		if(count($this->selectedKeys)){
			$key = collect($this->selectedKeys)->first();
			return $this->emit('edit-grade', $key);
		}
	}

	public function deleteAction()
	{
		if(count($this->selectedKeys)){
			return $this->emit('delete-grade', $this->selectedKeys) ;
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
			Column::make('Grade'),
			Column::make('Gross Salary'),
			Column::make('Leave Days'),
		];
	}

	public function query()
	{
		return Grade::query()
			->when($this->getFilter('search'),
				fn ($query, $term) => $query->search($term)
        );
        
	}


}
