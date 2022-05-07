<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\ProgressType;


class Promotion extends LivewireUI
{
    public Employee $employee;
    public $progressType;
    public $designation;
    public $grade;
    public $notch=1;
    public $startdate;
    public $enddate;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.promotion');         
    }

    public function save()
    {
        $this->validation();

        Progress::make(
            $this->employee,
            $this->progressType,
            $this->designation,
            $this->grade,
            $this->notch,
            $this->startdate,
            $this->enddate
        );
        $this->browseMode()->emitRefresh()->toastr('Promotion saved');
    }

    public function viewData()
    {
        $this->with('designations', Designation::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', Grade::pluck('grade')->toArray());
        $this->with('progressType', ['Promotion', 'Increment']);
    }

    public function validation()
    {
        if($this->isPromotion()){
            $this->validate([
                'designation' => 'nullable|numeric',
                'grade' => 'required|string',
                'notch' => 'required|numeric',
                'startdate' => 'required|date',
                'enddate' => 'nullable|date',
            ]);
        }
        elseif($this->isIncrement()) {
            $this->validate([
                'notch' => 'required|numeric',
                'startdate' => 'required|date'
            ]);
        }
        else{
            $this->validate([
                'progressType' => 'required'
            ]);
        }
    }

    public function notches($grade)
    {
        return Notch::where('grade', $grade)->pluck('notch')->toArray();
    }

    public function isPromotion()
    {
        return ($this->progressType === 'Promotion')? true:false;
    }

    public function isIncrement()
    {
        return ($this->progressType === 'Increment')? true:false;
    }

}
