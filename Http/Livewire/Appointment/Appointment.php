<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Appointment;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\HRSettings\Entities\JobGrade;
use Luanardev\Modules\HRSettings\Entities\JobNotch;
use Luanardev\Modules\HRSettings\Entities\JobScale;
use Luanardev\Modules\HRSettings\Entities\Position;

class Appointment extends LivewireUI
{
    public Staff $staff;
    public $position;
    public $grade;
    public $scale;
    public $notch;
    public $startdate;
    public $enddate;
    private $progressType = 'Appointment';

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.appointment.create');         
    }

    public function save()
    {
        $this->validate();

        if($this->staff->employment->isAppointed()){
            $position = $this->staff->employment->getPosition();
            $this->toastrError('Staff already appointed as '. $position);
            return false;
        }

        if(empty($this->enddate)){
            $this->enddate = $this->staff->employment->end_date;
        }
        
        Progress::make(
            $this->staff,
            $this->progressType,
            $this->position,
            $this->grade,
            $this->scale,
            $this->notch,
            $this->startdate,
            $this->enddate
        );
		
        $this->browseMode()->emitRefresh()->toastr('Appointment saved');
    }

    public function viewData()
    {
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('id','name')->flip()->toArray());
        $this->with('scales', JobScale::pluck('scale')->toArray());
    }

    public function rules()
    {
        return [
            'position' => 'nullable|numeric',
            'grade' => 'nullable|numeric',
            'scale' => 'required|string',
            'notch' => 'required|numeric',
            'startdate' => 'required|date',
            'enddate' => 'nullable|date',
        ];
    }

    public function notches($scale)
    {
        return JobNotch::where('scale', $scale)->pluck('notch')->toArray();
    }

}
