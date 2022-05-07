<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Award;
use Luanardev\Modules\Employees\Entities\Employee;

class StaffAward extends StaffProfile
{
    public Award $award;

    public function mount(Employee $employee)
    {
        parent::mount($employee);
        $this->award = new Award();

    }

    public function render()
    {
        return view('employees::livewire.staff.award.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function edit($id=null)
    {
        $this->award = Award::find($id);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        Award::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Award deleted');
    }

    public function save()
    {
        $this->validate();
        $this->award->employee()->associate($this->employee);
        $this->award->save();
        $this->browseMode()->emitRefresh()->toastr('Award saved');
    }

    public function rules()
    {
        return[
            'award.name' => 'required|string',
            'award.institution' => 'required|string',
            'award.country' => 'required|string',
            'award.year' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-award'  => 'create',
            'edit-award'    => 'edit',
            'delete-award'  => 'delete',
        ];
    }

    public function viewData()
    {
        $this->with('country', $this->country());
    }


}
