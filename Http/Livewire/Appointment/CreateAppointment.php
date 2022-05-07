<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Appointment;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;

class CreateAppointment extends LivewireUI
{
    public Employee $employee;
    public $designation;
    public $grade;
    public $notch;
    public $startdate;
    public $enddate;
    private $progressType = 'Appointment';

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.appointment.create');         
    }

    public function save()
    {
        $this->validate();

        if($this->employee->employment->isAppointed()){
            $designation = $this->employee->employment->getDesignation();
            $this->toastrError('Employee already appointed as '. $designation);
            return false;
        }

        if(empty($this->enddate)){
            $this->enddate = $this->employee->employment->end_date;
        }
        
        Progress::make(
            $this->employee,
            $this->progressType,
            $this->designation,
            $this->grade,
            $this->notch,
            $this->startdate,
            $this->enddate
        );
        $this->browseMode()->emitRefresh()->toastr('Appointment saved');
    }

    public function viewData()
    {
        $this->with('designations', Designation::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', Grade::pluck('grade')->toArray());
    }

    public function rules()
    {
        return [
            'designation' => 'nullable|numeric',
            'grade' => 'required|string',
            'notch' => 'required|numeric',
            'startdate' => 'required|date',
            'enddate' => 'nullable|date',
        ];
    }

    public function notches($grade)
    {
        return Notch::where('grade', $grade)->pluck('notch')->toArray();
    }

}
