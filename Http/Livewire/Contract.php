<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;

class Contract extends LivewireUI
{ 
    public Employee $employee;
    public $designation;
    public $grade;
    public $notch=1;
    public $startdate;
    public $enddate;
    private $progressType = 'Contract';

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->designation = $employee->employment->designation->id;
        $this->grade = $employee->employment->grade;
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.contract');
    }

    public function save()
    {
        $this->validate();
        Progress::make(
            $this->employee,
            $this->progressType,
            $this->designation,
            $this->grade,
            $this->notch,
            $this->startdate,
            $this->enddate
        );
        $this->browseMode()->emitRefresh()->toastr('Contract Renewed');
    }

    public function viewData()
    {
        $this->with('designations', Designation::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', Grade::pluck('grade')->toArray());
    }

    public function rules()
    {      
        return [
            'designation' => 'required|numeric',
            'grade' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
        ]; 
    }

}
