<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\EmploymentType;
use Luanardev\Modules\Employees\Entities\EmployeeCategory;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\Institution\Entities\Campus;

class Confirmation extends LivewireUI
{
    public $confirmDate;
    public Employee $employee;
	public Employment $employment;

	public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->employment = $employee->employment;
    }

    public function render()
    {
        return view('employees::livewire.confirmation');
    }

    public function save()
    {
        if($this->employment->isPermanent() && $this->employment->isNotConfirmed() ){
            $this->employment->confirmation($this->confirmDate);
            $this->emitRefresh()->toastr('Confirmation successful');
        }else{
            $this->emitRefresh()->toastrError('Employee already confirmed');
        }
    }


}
