<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\EmploymentType;
use Luanardev\Modules\Employees\Entities\EmployeeCategory;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\Institution\Entities\Campus;


class StaffEmployment extends StaffProfile
{
	public Employment $employment;

	public function mount(Employee $employee)
    {
        parent::mount($employee);
        $this->employment = $employee->employment;
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
		$this->employment->setKey($this->employee->getKey() );
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
            'employment.grade' => 'required|string',
            'employment.notch' => 'required|numeric',
            'employment.designation_id' => 'required',
            'employment.department_id' => 'required',
            'employment.section_id' => 'required',
            'employment.campus_id' => 'required',
            'employment.employment_type' => 'required',
            'employment.employee_category' => 'required',
            'employment.employment_status' => 'required',
            'employment.start_date' => 'required|date',
            'employment.end_date' => 'nullable|date'
        ];
    }

    public function viewData()
    {
        $this->with('designations', Designation::pluck('id', 'name')->flip()->toArray());
        $this->with('departments', Department::pluck('id', 'name')->flip()->toArray());
        $this->with('sections', Section::pluck('id', 'name')->flip()->toArray());
        $this->with('campuses', Campus::getByUser()->pluck('id', 'name')->flip()->toArray());
        $this->with('grades', Grade::pluck('grade')->toArray());
        $this->with('types', EmploymentType::pluck('id', 'name')->flip()->toArray());
        $this->with('categories', EmployeeCategory::pluck('id', 'name')->flip()->toArray() );
        $this->with('statuses', EmploymentStatus::pluck('id', 'name')->flip()->toArray() );

    }

    public function notches($grade)
    {
        return Notch::where('grade', $grade)->pluck('notch')->toArray();
    }


}
