<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Kinsman;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Enums\WithEnums;

class KinsmanWizard extends LivewireUI
{
    use WithEnums;

    public Kinsman $kinsman;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();

    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.registration.kinsman.create');
    }

    public function save()
    {
        if(!session()->exists('employee')){
            return false;
        }

        $this->validate();
        $employee = Employee::find(session()->get('employee'));
        $this->kinsman->employee()->associate($employee);
        $this->kinsman->save();
        $this->toastr('Next of Kin saved');
    }

    public function rules()
    {
        return [
            'kinsman.title' => 'required|string',
            'kinsman.firstname' => 'required|string',
            'kinsman.lastname' => 'required|string',
            'kinsman.middlename' => 'nullable|string',
            'kinsman.relation' => 'required|string',
            'kinsman.occupation' => 'nullable|string',
            'kinsman.organisation' => 'nullable|string',
            'kinsman.contact_address' => 'required|string',
            'kinsman.phone1' => 'required|string',
            'kinsman.phone2' => 'nullable|string',
        ];

    }

    public function recovery()
    {
        if(session()->exists('employee')){
            $employee = Employee::find(session()->get('employee'));
            $this->kinsman = $employee->kinsman;
        }else{
            $this->kinsman = new Kinsman();
        }

    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('relation', $this->family());
    }


}
