<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\EmployeeCategory;

class EmployeeCategoryConfig extends LivewireUI
{
    public EmployeeCategory $employeeCategory;

    public function __construct()
    {
        $this->employeeCategory = new EmployeeCategory();
    }

    public function render()
    {
        return view('employees::livewire.settings.employee-category.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($id=null)
    {
        $this->employeeCategory = EmployeeCategory::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        EmployeeCategory::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Employee Category deleted');
    }

    public function save()
    {
        $this->validate();
        $this->employeeCategory->save();
        $this->browseMode()->emitRefresh()->toastr('Employee Category saved');
    }

    public function rules()
    {
        return[
            'employeeCategory.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-employee-category'  => 'create',
            'edit-employee-catgory'    => 'edit',
            'delete-employee-category'  => 'delete',
        ];
    }

  
}
