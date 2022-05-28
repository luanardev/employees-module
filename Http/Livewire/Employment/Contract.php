<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Employment;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\HRSettings\Entities\JobGrade;
use Luanardev\Modules\HRSettings\Entities\JobScale;
use Luanardev\Modules\HRSettings\Entities\JobNotch;
use Luanardev\Modules\HRSettings\Entities\Position;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Progress;


class Contract extends LivewireUI
{ 
    public Staff $staff;
    public $position;
    public $grade;
    public $scale;
    public $notch=1;
    public $startdate;
    public $enddate;
    private $progressType = 'Contract';

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->position = $staff->employment->position->id;
        $this->grade = $staff->employment->grade->id;
        $this->scale = $staff->employment->scale;
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.employment.contract');
    }

    public function save()
    {
        $this->validate();
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
        $this->browseMode()->emitRefresh()->toastr('Contract Renewal successful');
    }

    public function viewData()
    {
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('id','name')->flip()->toArray());
        $this->with('scales', JobScale::pluck('scale')->toArray());
    }

    public function notches($scale)
    {
        return JobNotch::where('scale', $scale)->pluck('notch')->toArray();
    }

    public function rules()
    {      
        return [
            'position' => 'required|numeric',
            'grade' => 'required|numeric',
            'scale' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
        ]; 
    }

}
