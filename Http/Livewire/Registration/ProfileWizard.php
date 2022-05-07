<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Enums\WithEnums;

class ProfileWizard extends LivewireUI
{
    use WithEnums;

    public Employee $employee;

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
        if(session()->exists('employee')){
            session()->forget('employee');
            $this->resetFields();
            $this->alert('Employee added successfully');
            $this->redirect(route('employee.create'));
        }else{
            session()->forget('success');
        }

    }

    public function save()
    {
        $this->validate();
        $this->employee->save();
        session()->put('employee', $this->employee->id);
        $this->toastr('Profile saved');
    }

    public function rules()
    {
        return [
            'employee.id' => 'nullable',
            'employee.national_id' => 'nullable',
            'employee.title' => 'required|string',
            'employee.firstname' => 'required|string',
            'employee.lastname' => 'required|string',
            'employee.middlename' => 'nullable|string',
            'employee.marital_status' => 'required|string',
            'employee.date_of_birth' => 'required|date',
            'employee.gender' => 'required|string',
            'employee.contact_address' => 'required|string',
            'employee.personal_email' => 'required|email',
            'employee.official_email' => 'nullable|email',
            'employee.phone1' => 'required|string',
            'employee.phone2' => 'nullable|string',
            'employee.home_village' => 'required|string',
            'employee.home_authority' => 'required|string',
            'employee.home_district' => 'required|string',
            'employee.residence_country' => 'required|string'
        ];
    }

    public function getListeners()
    {
        return [
            'create-employee'  => 'create'
        ];
    }

    public function resetFields()
    {
        $this->reset(['employee']);
    }

    public function recovery()
    {
        if(session()->exists('employee')){
            $this->employee = Employee::find(session()->get('employee'));
        }else{
            $this->employee = new Employee;

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
