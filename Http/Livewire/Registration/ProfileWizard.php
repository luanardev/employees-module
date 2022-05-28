<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Enums\WithEnums;

class ProfileWizard extends LivewireUI
{
    use WithEnums;

    public Staff $staff;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
    }

    public function render()
    {
        $this->viewData();
        return view("employees::livewire.registration.profile.create");
    }

    public function create()
    {
        if(session()->exists('staff')){
            session()->forget('staff');
            $this->resetFields();
            $this->alert('Staff added successfully');
            $this->redirect(route('staff.create'));
        }else{
            session()->forget('success');
        }

    }

    public function save()
    {
        $this->validate();
        $this->staff->save();
        session()->put('staff', $this->staff->id);
        $this->toastr('Profile saved');
    }

    public function rules()
    {
        return [
            'staff.id' => 'nullable',
            'staff.national_id' => 'nullable',
            'staff.title' => 'required|string',
            'staff.firstname' => 'required|string',
            'staff.lastname' => 'required|string',
            'staff.middlename' => 'nullable|string',
            'staff.marital_status' => 'required|string',
            'staff.date_of_birth' => 'required|date',
            'staff.gender' => 'required|string',
            'staff.contact_address' => 'required|string',
            'staff.personal_email' => 'required|email',
            'staff.official_email' => 'nullable|email',
            'staff.phone1' => 'required|string',
            'staff.phone2' => 'nullable|string',
            'staff.home_village' => 'required|string',
            'staff.home_authority' => 'required|string',
            'staff.home_district' => 'required|string',
            'staff.residence_country' => 'required|string'
        ];
    }

    public function getListeners()
    {
        return [
            'create-staff'  => 'create'
        ];
    }

    public function resetFields()
    {
        $this->reset(['staff']);
    }

    public function recovery()
    {
        if(session()->exists('staff')){
            $this->staff = Staff::find(session()->get('staff'));
        }else{
            $this->staff = new Staff;

        }
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('gender', $this->gender());
        $this->with('maritalStatus', $this->maritalStatus());
        $this->with('district', $this->district());
        $this->with('country', $this->country());
    }

}
