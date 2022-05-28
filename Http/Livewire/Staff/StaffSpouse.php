<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Spouse;
use Luanardev\Modules\Employees\Entities\Staff;

class StaffSpouse extends StaffProfile
{
    public Spouse $spouse;

    public function mount(Staff $staff)
    {
        parent::mount($staff);
        $this->spouse = new Spouse();
    }

    public function render()
    {
        return view('employees::livewire.staff.spouse.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function edit($id=null)
    {
        $this->spouse = Spouse::find($id);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($key)
    {
        Spouse::destroy($key);
        $this->browseMode()->emitRefresh()->toastr('Spouse deleted');
    }

    public function save()
    {
        $this->validate();
        $this->spouse->staff()->associate($this->staff);
        $this->spouse->save();
        $this->browseMode()->emitRefresh()->toastr('Spouse saved');
    }

    public function rules()
    {
        return [
            'spouse.title' => 'required|string',
            'spouse.firstname' => 'required|string',
            'spouse.lastname' => 'required|string',
            'spouse.middlename' => 'nullable|string',
            'spouse.date_of_birth' => 'date',
            'spouse.gender' => 'required|string',
            'spouse.contact_address' => 'required|string',
            'spouse.phone1' => 'required|string',
            'spouse.phone2' => 'nullable|string',
            'spouse.residence_country' => 'required|string',
            'spouse.home_village' => 'required|string',
            'spouse.home_authority' => 'required|string',
            'spouse.home_district' => 'required|string',

        ];

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
