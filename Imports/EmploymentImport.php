<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\EmployeeCategory;
use Luanardev\Modules\Employees\Entities\EmploymentType;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;
use Luanardev\Modules\Employees\Concerns\WithExcelDate;
use Luanardev\Modules\Institution\Entities\Branch;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;


class EmploymentImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    use WithExcelDate;

    public function model(array $row)
    {
        $employment = $this->getEmployment($row['employee_id']);
        $enddate = null;
        if(!empty($row['end_date'])){
            $enddate =  $this->transformDate($row['end_date']);
        }
        $employment->grade = $row['grade'];
        $employment->notch = $row['notch'];
        $employment->employee_category = $this->getEmployeeCategory($row['employee_category']);
        $employment->employment_type = $this->getEmploymentType($row['employment_type']);
        $employment->employment_status = $this->getEmploymentStatus($row['employment_status']);
        $employment->setTenure( $this->transformDate($row['start_date']), $enddate);
        $employment->designation_id = $this->getDesignation($row['designation']);
        $employment->branch_id = $this->getBranch($row['branch']);
        $employment->campus_id = $this->getCampus($row['campus']);
        $employment->department_id = $this->getDepartment($row['department']);
        $employment->section_id = $this->getSection($row['section']); 
            
        return $employment;
    }

    public function rules(): array
    {
        return [
            'employee_id'           =>  'required|numeric',
            'grade'                 =>  'required|string',
            'notch'                 =>  'required|numeric',
            'employee_category'     =>  'required|string',
            'employment_type'       =>  'required|string',
            'employment_status'     =>  'required|string',
            'start_date'            =>  'required',
            'end_date'              =>  'nullable',
            'period'                =>  'nullable|numeric',
            'designation'           =>  'required|string',
            'branch'                =>  'required|string',
            'campus'                =>  'required|string',
            'department'            =>  'required|string',
            'section'               =>  'required|string',
        ];
    }

    private function getEmployment($employeeId)
    {
        $record = Employment::find($employeeId);
        if(empty($record)){
            $record = new Employment;
            $record->setKey($employeeId);
        }
        return $record;
    }

    private function getDesignation($name)
    {
        $record = Designation::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }

    private function getDepartment($name)
    {
        $record = Department::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }

    private function getBranch($name)
    {
        $record = Branch::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }

    private function getSection($name)
    {
        $record = Section::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }

    private function getCampus($name)
    {
        $record = Campus::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }
	
	private function getEmployeeCategory($name)
    {
        $record = EmployeeCategory::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }
	
	private function getEmploymentType($name)
    {
        $record = EmploymentType::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }

    private function getEmploymentStatus($name)
    {
        $record = EmploymentStatus::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }
    
}
