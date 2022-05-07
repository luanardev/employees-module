<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Dependant;
use Luanardev\Modules\Employees\Concerns\WithExcelDate;

class DependantImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    use WithExcelDate;

    public function model(array $row)
    {
        $dependant = $this->getDependant(
            $row['employee_id'],
            $row['first_name'],
            $row['last_name'],
            $row['relation'],
        );

        $dependant->fill([
            'employee_id'       =>  $row['employee_id'],
            'title'             =>  $row['title'],
            'firstname'         =>  $row['first_name'],
            'lastname'          =>  $row['last_name'],
            'date_of_birth'     =>  $this->transformDate($row['date_of_birth']),
            'gender'            =>  $row['gender'],
            'relation'          =>  $row['relation']
        ]);

        return $dependant;
    }

    public function rules(): array
    {
        return [
            'employee_id'           =>  'required|numeric',
            'title'                 =>  'required|string',
            'first_name'            =>  'required|string',
            'last_name'             =>  'required|string',
            'date_of_birth'         =>  'required',
            'gender'                =>  'required|string',
            'relation'              =>  'required|string',
        ];
    }

    private function getDependant($employeeId, $firstname, $lastname, $relation)
    {
        $record = Dependant::where('employee_id',$employeeId)
                ->where('firstname', $firstname)
                ->where('lastname', $lastname)
                ->where('relation', $relation)
                ->first();

        if(empty($record)){
            $record = new Dependant;
        }
        return $record;
    }


}
