<?php

namespace Luanardev\Modules\Employees\Reports;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\QualificationLevel;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\EmploymentType;
use Luanardev\Modules\Employees\Entities\EmployeeCategory;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;


class EmployeeFilter extends ReportFilter
{

    public function filters(): array
	{
		return [

            'campus' => Filter::make('Campus')->select(
				Campus::getByUser()->pluck('name')->toArray()
			),

            'department' => Filter::make('Department')->select(
				Department::pluck('name')->toArray()
			),

            'section' => Filter::make('Section')->select(
				Section::pluck('name')->toArray()
			),

            'appointment' => Filter::make('Appointment')->select(
				EmploymentType::pluck('name')->toArray()
			),

            'category' => Filter::make('Category')->select(
				EmployeeCategory::pluck('name')->toArray()
			),

            'grade' => Filter::make('Grade')->select(
				Grade::pluck('grade')->toArray()
			),

			'status' => Filter::make('Status')->select(
				EmploymentStatus::pluck('name')->toArray()
            )
		];
	}

    public function groups(): array
    {
        return [
            'gender'        => 'Gender',
            'department'    => 'Department',
            'section'       => 'Section',
            'appointment'   => 'Appointment',
            'category'      => 'Category',
            'grade'         => 'Grade',
            'status'         => 'Status',
        ];
    }



}
