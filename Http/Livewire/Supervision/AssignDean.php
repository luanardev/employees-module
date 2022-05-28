<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Supervision;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Deanship;
use Luanardev\Modules\Institution\Entities\Faculty;
use Luanardev\Modules\Institution\Entities\Campus;

class AssignDean extends LivewireUI
{
    public Staff $staff;
    public $faculty;
    public $campus;
    public $position;


    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->campus = $staff->employment->campus_id;
    }

    public function save()
    {
        if($this->staff->hasDeanship()){
            return $this->toastrError('Staff already assigned');
        }
 
        $deanship = new Deanship;
        if($deanship->isAssigned($this->faculty,$this->campus, $this->position)){
            return $this->toastrError('Deanship already assigned');
        }else{
            $deanship->assign($this->staff, $this->faculty, $this->campus, $this->position);
            return $this->emitRefresh()->toastr('Operation successful');
        }
       
    }
    
    public function render()
    {
        $this->viewData();
        return view('employees::livewire.supervision.dean');
    }

    public function viewData()
    {
        $this->with('faculty', Faculty::pluck('id', 'name')->flip()->toArray() );
        $this->with('campus', Campus::pluck('id', 'name')->flip()->toArray() );
        $this->with('position', Deanship::positions());
    }
}
