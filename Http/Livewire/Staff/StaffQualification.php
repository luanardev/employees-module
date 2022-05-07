<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Qualification;
use Luanardev\Modules\Employees\Entities\QualificationLevel;
use Luanardev\Modules\Employees\Entities\Employee;

class StaffQualification extends StaffProfile
{
    public Qualification $qualification;

    public function mount(Employee $employee)
    {
        parent::mount($employee);
        $this->qualification = new Qualification();

    }

    public function render()
    {
        return view('employees::livewire.staff.qualification.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function edit($id=null)
    {
        $this->qualification = Qualification::find($id);
        $this->editMode();
        $this->viewData();
    }

    public function setHighest($key)
    {
        $qualification = Qualification::findorfail($key);
        $this->employee->updateQuietly([
            'qualification' => $qualification->level
        ]);
        $this->browseMode()->emitRefresh()->toastr('Set Highest successful');

    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        Qualification::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Qualification deleted');
    }

    public function save()
    {
        $this->validate();
        $this->qualification->employee()->associate($this->employee);
        $this->qualification->save();
        $this->browseMode()->emitRefresh()->toastr('Qualification saved');
    }

    public function rules()
    {
        return[
            'qualification.name' => 'required|string',
            'qualification.level' => 'required',
            'qualification.specialization' => 'nullable|string',
            'qualification.institution' => 'required|string',
            'qualification.country' => 'required|string',
            'qualification.year' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-qualification'  => 'create',
            'edit-qualification'    => 'edit',
            'delete-qualification'  => 'delete',
            'set-highest'           => 'setHighest',
        ];
    }

    public function viewData()
    {
        $this->with('country', $this->country());
        $this->with('level', QualificationLevel::pluck('id','name')->flip()->toArray());
    }


}
