<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\Modules\Employees\Entities\Experience;
use Luanardev\Modules\Employees\Entities\Staff;
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
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->experience->staff()->associate($staff);
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
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $experience = $staff->experience()->get();
            $this->with('experience', $experience);
        }else{
            $this->create();
        }
    }


}
