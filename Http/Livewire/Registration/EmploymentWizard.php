<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\EmploymentType;
use Luanardev\Modules\Employees\Entities\EmployeeCategory;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;
use Luanardev\Modules\Employees\Enums\WithEnums;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Entities\Branch;


class EmploymentWizard extends LivewireUI
{
    use WithEnums;

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
        if(!session()->exists('employee')){
            return false;
        }

        $this->validate();

        $employeeId = session()->get('employee');

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
            'employment.grade' => 'required|string',
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
        $this->with('notches', Notch::pluck('notch')->toArray());
        $this->with('types', EmploymentType::pluck('id', 'name')->flip()->toArray());
        $this->with('categories', EmployeeCategory::pluck('id', 'name')->flip()->toArray() );
        $this->with('statuses', EmploymentStatus::pluck('id', 'name')->flip()->toArray() );


    }

    public function recovery()
    {
        if(session()->exists('employee')){
            $employee = Employee::find(session()->get('employee'));
            $this->employment = $employee->employment;
        }else{
            $this->employment = new Employment();
        }
    }

    public function notches($grade)
    {
        return Notch::where('grade', $grade)->pluck('notch')->toArray();
    }

}
