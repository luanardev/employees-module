<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\EmploymentType;

class EmploymentTypeConfig extends LivewireUI
{
    public EmploymentType $employmentType;

    public function __construct()
    {
        $this->employmentType = new EmploymentType();
    }

    public function render()
    {
        return view('employees::livewire.settings.employment-type.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($id=null)
    {
        $this->employmentType = EmploymentType::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        EmploymentType::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Employment Type deleted');
    }

    public function save()
    {
        $this->validate();
        $this->employmentType->save();
        $this->browseMode()->emitRefresh()->toastr('Employment Type saved');
    }

    public function rules()
    {
        return[
            'employmentType.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-employment-type'  => 'create',
            'edit-employment-type'    => 'edit',
            'delete-employment-type'  => 'delete',
        ];
    }

  
}
