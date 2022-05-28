<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Supervision;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Managership;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\Institution\Entities\Campus;

class AssignManager extends LivewireUI
{
    public Staff $staff;
    public $section;
    public $campus;
    public $position;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->campus = $staff->employment->campus_id;
    }

    public function save()
    {
        if($this->staff->hasManagership()){
            return $this->toastrError('Staff already assigned');
        }
 
        $manager = new Managership;
        if($manager->isAssigned($this->section,$this->campus, $this->position)){
            return $this->toastrError('Headship already assigned');
        }else{
            $manager->assign($this->staff, $this->section, $this->campus, $this->position);
            return $this->emitRefresh()->toastr('Operation successful');
        }
        
    }
    
    public function render()
    {
        $this->viewData();
        return view('employees::livewire.supervision.manager');
    }

    public function viewData()
    {
        $this->with('section', Section::pluck('id', 'name')->flip()->toArray() );
        $this->with('campus', Campus::pluck('id', 'name')->flip()->toArray() );
        $this->with('position', Managership::positions());
    }
}
