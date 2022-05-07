<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Qualification;
use Luanardev\Modules\Employees\Entities\QualificationLevel;

class QualificationImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;

    public function model(array $row)
    {
        $qualification  = $this->getQualification(
            $row['employee_id'],
            $row['qualification'], 
            $row['institution']
        );
		
		$qualificationLevel = $this->getQualificationLevel($row['qualification_level']);

        $qualification->fill([
            'employee_id'       =>  $row['employee_id'],
            'name'              =>  $row['qualification'],
            'specialization'    =>  $row['specialization'],
            'level'				=>  $qualificationLevel,
            'institution'       =>  $row['institution'],
            'country'           =>  $row['country'],
            'year'              =>  $row['year']
        ]);

        return $qualification;
    }

    public function rules(): array
    {
        return [
            'employee_id'           =>  'required|numeric',
            'qualification'         =>  'required|string',
            'specialization'        =>  'nullable|string',
            'qualification_level'   =>  'required|string',
            'institution'           =>  'required|string',
            'country'               =>  'required|string',
            'year'                  =>  'required|numeric',
        ];
    }

    private function getQualification($employeeId, $qualification, $institution)
    {
        $record = Qualification::where('employee_id',$employeeId)
            ->where('name', $qualification)
            ->where('institution', $institution)
            ->first();

        if(empty($record)){
            $record = new Qualification;
        }
        return $record;
    }
	
	private function getQualificationLevel($name)
    {
        $record = QualificationLevel::findByName($name);
        if(empty($record)){
            return null;
        }
        return $record->getKey();
    }
  
}
