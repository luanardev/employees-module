<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Enums\WithEnums;

class StaffProfile extends LivewireUI
{
    use WithEnums;

    public Employee $employee;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function render()
    {
        return view("employees::livewire.staff.profile.index");
    }

    public function edit($id=null)
    {
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function save()
    {
        $this->validate();
        $this->employee->save();
        $this->browseMode()->emitRefresh()->toastr('Profile updated');
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('gender', $this->gender());
        $this->with('maritalStatus', $this->maritalStatus());
        $this->with('district', $this->district());
        $this->with('country', $this->country());
    }

    public function rules()
    {
        return [
            'employee.national_id' => 'nullable|string',
            'employee.title' => 'required|string',
            'employee.firstname' => 'required|string',
            'employee.lastname' => 'required|string',
            'employee.middlename' => 'nullable|string',
            'employee.marital_status' => 'required|string',
            'employee.date_of_birth' => 'required|date',
            'employee.gender' => 'required|string',
            'employee.contact_address' => 'required|string',
            'employee.personal_email' => 'required|email',
            'employee.phone1' => 'required|string',
            'employee.phone2' => 'nullable|string',
            'employee.home_village' => 'required|string',
            'employee.home_authority' => 'required|string',
            'employee.home_district' => 'required|string',
            'employee.residence_country' => 'required|string',
        ];
    }

}
