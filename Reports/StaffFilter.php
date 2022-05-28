<?php

namespace Luanardev\Modules\Employees\Reports;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Luanardev\Modules\HRSettings\Entities\Position;
use Luanardev\Modules\HRSettings\Entities\QualificationLevel;
use Luanardev\Modules\HRSettings\Entities\JobScale;
use Luanardev\Modules\HRSettings\Entities\JobType;
use Luanardev\Modules\HRSettings\Entities\JobCategory;
use Luanardev\Modules\HRSettings\Entities\JobStatus;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;


class StaffFilter extends ReportFilter
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
				JobType::pluck('name')->toArray()
			),

            'category' => Filter::make('Category')->select(
				JobCategory::pluck('name')->toArray()
			),

            'scale' => Filter::make('Scale')->select(
				JobScale::pluck('scale')->toArray()
			),

			'status' => Filter::make('Status')->select(
				JobStatus::pluck('name')->toArray()
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
            'scale'         => 'JobScale',
            'status'         => 'Status',
        ];
    }



}
