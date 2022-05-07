<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\Modules\Employees\Entities\Experience;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\LivewireUI\LivewireUI;

class ExperienceWizard extends LivewireUI
{
    public Experience $experience;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
        $this->experience = new Experience;
    }

    public function render()
    {
        return view('employees::livewire.registration.experience.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function show()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($keys)
    {
        Experience::destroy($keys);
        $this->browse();
        return $this->toastr('Experience deleted');
    }

    public function save()
    {
        if(!session()->exists('employee')){
            return false;
        }

        $this->validate();
        $employee = Employee::find(session()->get('employee'));
        $this->experience->employee()->associate($employee);
        $this->experience->save();
        $this->resetFields();
        $this->toastr('Experience saved');
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

    public function resetFields()
    {
        $this->reset(['experience']);
    }

    public function recovery()
    {
        if(session()->exists('employee')){
            $employee = Employee::find(session()->get('employee'));
            $experience = $employee->experience()->get();
            $this->with('experience', $experience);
        }else{
            $this->create();
        }
    }


}
