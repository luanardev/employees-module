<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;

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


class StaffEmployment extends StaffProfile
{
	public Employment $employment;

	public function mount(Staff $staff)
    {
        parent::mount($staff);
        $this->employment = $staff->employment;
    }

    public function render()
    {
        return view('employees::livewire.staff.employment.index');
    }

    public function edit($id=null)
    {
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function dismiss()
    {
        if($this->employment->isAppointed()){
            $this->employment->dismiss();
            $this->browseMode()->emitRefresh()->toastr('Appointment dismissed');
        }
    }

    public function terminate()
    {
        if($this->employment->isNotPermanent()){
            $this->employment->terminate();
            $this->browseMode()->emitRefresh()->toastr('Contract terminated');
        }
    }

    public function save()
    {
        $this->validate();
		$this->employment->setKey($this->staff->getKey() );
        $this->employment->setTenure(
            $this->employment->start_date,
            $this->employment->end_date
        );
        $this->employment->save();
        $this->browseMode()->emitRefresh()->toastr('Employment saved');
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

    public function notches($scale)
    {
        return JobNotch::where('scale', $scale)->pluck('notch')->toArray();
    }


}
