<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Enums\WithEnums;

class StaffProfile extends LivewireUI
{
    use WithEnums;

    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
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
        $this->staff->save();
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
            'staff.national_id' => 'nullable|string',
            'staff.title' => 'required|string',
            'staff.firstname' => 'required|string',
            'staff.lastname' => 'required|string',
            'staff.middlename' => 'nullable|string',
            'staff.marital_status' => 'required|string',
            'staff.date_of_birth' => 'required|date',
            'staff.gender' => 'required|string',
            'staff.contact_address' => 'required|string',
            'staff.personal_email' => 'required|email',
            'staff.phone1' => 'required|string',
            'staff.phone2' => 'nullable|string',
            'staff.home_village' => 'required|string',
            'staff.home_authority' => 'required|string',
            'staff.home_district' => 'required|string',
            'staff.residence_country' => 'required|string',
        ];
    }

}
