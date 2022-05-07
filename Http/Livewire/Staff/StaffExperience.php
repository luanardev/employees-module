<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Experience;
use Luanardev\Modules\Employees\Entities\Employee;

class StaffExperience extends StaffProfile
{
    public Experience $experience;

    public function mount(Employee $employee)
    {
        parent::mount($employee);
        $this->experience = new Experience();
    }

    public function render()
    {
        return view('employees::livewire.staff.experience.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($id=null)
    {
        $this->experience = Experience::find($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        Experience::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Experience deleted');
    }

    public function save()
    {
        $this->validate();
        $this->experience->employee()->associate($this->employee);
        $this->experience->save();
        $this->browseMode()->emitRefresh()->toastr('Experience saved');
    }

    public function rules()
    {
        return[
            'experience.job_position' => 'required|string',
            'experience.employer_name' => 'required|string',
            'experience.employer_address' => 'nullable|string',
            'experience.employer_phone' => 'nullable|string',
            'experience.start_date' => 'required|date',
            'experience.end_date' => 'required|date',
        ];

    }

    public function getListeners()
    {
        return [
            'create-experience'  => 'create',
            'edit-experience'    => 'edit',
            'delete-experience'  => 'delete',
        ];
    }


}
