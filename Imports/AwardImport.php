<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Award;

class AwardImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;

    public function model(array $row)
    {
        $award = $this->getAward(
            $row['employee_id'],
            $row['award'], 
            $row['institution']
        );

        $award->fill([
            'employee_id'       =>  $row['employee_id'],
            'name'              =>  $row['award'],
            'institution'       =>  $row['institution'],
            'country'           =>  $row['country'],
            'year'              =>  $row['year']
        ]);
        
        return $award;
    }

    public function rules(): array
    {
        return [
            'employee_id'           =>  'required|numeric',
            'award'                 =>  'required|string',
            'institution'           =>  'required|string',
            'country'               =>  'required|string',
            'year'                  =>  'required|numeric',
        ];
    }

    private function getAward($employeeId, $award, $institution)
    {
        $record = Award::where('employee_id', $employeeId)
            ->where('name',$award)
            ->where('institution', $institution)
            ->first();

        if(empty($record)){
            $record = new Award;
        }
        return $record;
    }

}
