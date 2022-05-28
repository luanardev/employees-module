<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Employment;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\HRSettings\Entities\JobGrade;
use Luanardev\Modules\HRSettings\Entities\JobNotch;
use Luanardev\Modules\HRSettings\Entities\JobScale;
use Luanardev\Modules\HRSettings\Entities\Position;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\Staff;



class Promotion extends LivewireUI
{
    public Staff $staff;
    public $progressType;
    public $position;
    public $grade;
    public $scale;
    public $notch=1;
    public $startdate;
    public $enddate;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.employment.promotion');         
    }

    public function save()
    {
        $this->validation();

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
        $this->browseMode()->emitRefresh()->toastr('Promotion successful');
    }

    public function viewData()
    {
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('id','name')->flip()->toArray());
        $this->with('scales', JobScale::pluck('scale')->toArray());
        $this->with('progressType', ['Promotion', 'Increment']);
    }

    public function validation()
    {
        if($this->isPromotion()){
            $this->validate([
                'position' => 'nullable|numeric',
                'grade' => 'required|numeric',
                'scale' => 'required|string',
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

    public function notches($scale)
    {
        return JobNotch::where('scale', $scale)->pluck('notch')->toArray();
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
