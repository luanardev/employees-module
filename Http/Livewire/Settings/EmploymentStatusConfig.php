<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;

class EmploymentStatusConfig extends LivewireUI
{
    public EmploymentStatus $employmentStatus;

    public function __construct()
    {
        $this->employmentStatus = new EmploymentStatus();
    }

    public function render()
    {
        return view('employees::livewire.settings.employment-status.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($id=null)
    {
        $this->employmentStatus = EmploymentStatus::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        EmploymentStatus::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Employment Status deleted');
    }

    public function save()
    {
        $this->validate();
        $this->employmentStatus->save();
        $this->browseMode()->emitRefresh()->toastr('Employment Status saved');
    }

    public function rules()
    {
        return[
            'employmentStatus.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-employment-status'  => 'create',
            'edit-employment-status'    => 'edit',
            'delete-employment-status'  => 'delete',
        ];
    }

  
}
