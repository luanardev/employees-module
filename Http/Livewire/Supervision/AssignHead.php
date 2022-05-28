<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Supervision;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Headship;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Campus;

class AssignHead extends LivewireUI
{
    public Staff $staff;
    public $department;
    public $campus;
    public $position;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->campus = $staff->employment->campus_id;
    }

    public function save()
    {
        if($this->staff->hasHeadship()){
            return $this->toastrError('Staff already assigned');
        }
 
        $headship = new Headship;
        if($headship->isAssigned($this->department,$this->campus, $this->position)){
            return $this->toastrError('Headship already assigned');
        }else{
            $headship->assign($this->staff, $this->department, $this->campus, $this->position);
            return $this->emitRefresh()->toastr('Operation successful'); 
        }
        
    }
    
    public function render()
    {
        $this->viewData();
        return view('employees::livewire.supervision.head');
    }

    public function viewData()
    {
        $this->with('department', Department::pluck('id', 'name')->flip()->toArray() );
        $this->with('campus', Campus::pluck('id', 'name')->flip()->toArray() );
        $this->with('position', Headship::positions());
    }
}
