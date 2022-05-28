<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\HRSettings\Entities\JobGrade;
use Luanardev\Modules\HRSettings\Entities\JobNotch;
use Luanardev\Modules\HRSettings\Entities\JobScale;
use Luanardev\Modules\HRSettings\Entities\Position;
use Luanardev\Modules\HRSettings\Entities\JobType;
use Luanardev\Modules\HRSettings\Entities\JobCategory;
use Luanardev\Modules\HRSettings\Entities\JobStatus;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\Institution\Entities\Campus;


class EmploymentWizard extends LivewireUI
{
    public Employment $employment;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.registration.employment.create');
    }

    public function save()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();

        $employeeId = session()->get('staff');

        $this->employment->setKey($employeeId );
        $this->employment->setTenure(
            $this->employment->start_date,
            $this->employment->end_date
        );
        $this->employment->notch = 1;
        $this->employment->save();
        $this->toastr('Employment saved');
    }

    public function rules()
    {
        return [
			'employment.position_id' => 'required|numeric',
            'employment.grade_id' => 'required|numeric',
            'employment.scale' => 'required|string',
            'employment.notch' => 'required|numeric',          
            'employment.department_id' => 'required|numeric',
            'employment.section_id' => 'required|numeric',
            'employment.campus_id' => 'required|numeric',
            'employment.type_id' => 'required|numeric',
            'employment.category_id' => 'required|numeric',
            'employment.status_id' => 'required|numeric',
            'employment.start_date' => 'required|date',
            'employment.end_date' => 'nullable|date'
        ];
    }
    
    public function viewData()
    {
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('departments', Department::pluck('id', 'name')->flip()->toArray());
        $this->with('sections', Section::pluck('id', 'name')->flip()->toArray());
        $this->with('campuses', Campus::getByUser()->pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('id','name')->flip()->toArray());
        $this->with('scales', JobScale::pluck('scale')->toArray());
        $this->with('types', JobType::pluck('id', 'name')->flip()->toArray());
        $this->with('categories', JobCategory::pluck('id', 'name')->flip()->toArray() );
        $this->with('statuses', JobStatus::pluck('id', 'name')->flip()->toArray() );
    }

    public function recovery()
    {
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $this->employment = $staff->employment;
        }else{
            $this->employment = new Employment();
        }
    }

    public function notches($scale)
    {
        return JobNotch::where('scale', $scale)->pluck('notch')->toArray();
    }
}
