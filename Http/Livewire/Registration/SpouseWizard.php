<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Spouse;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Enums\WithEnums;

class SpouseWizard extends LivewireUI
{
    use WithEnums;

    public Spouse $spouse;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();

    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.registration.spouse.create');
    }

    public function save()
    {
        if(!session()->exists('employee')){
            return false;
        }
        $this->validate();
        $employee = Employee::find(session()->get('employee'));
        $this->spouse->employee()->associate($employee);
        $this->spouse->save();
        $this->toastr('Spouse saved');
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

    public function recovery()
    {
        if(session()->exists('employee')){
            $employee = Employee::find(session()->get('employee'));
            $this->spouse = $employee->spouse;
        }else{
            $this->spouse = new Spouse;
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
