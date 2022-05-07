<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Kinsman;

class KinsmanImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;

    public function model(array $row)
    {
        $kinsman = $this->getKinsman(
            $row['employee_id'],
            $row['first_name'],
            $row['last_name'],
            $row['relation']
        );

        $kinsman->fill([
            'employee_id'       =>  $row['employee_id'],
            'title'             =>  $row['title'],
            'firstname'         =>  $row['first_name'],
            'lastname'          =>  $row['last_name'],
            'middlename'        =>  $row['middle_name'],
            'relation'          =>  $row['relation'],
            'occupation'        =>  $row['occupation'],
            'organisation'      =>  $row['organisation'],
            'contact_address'   =>  $row['contact_address'],
            'phone1'     		=>  $row['phone_number_1'],
            'phone2'     		=>  $row['phone_number_2']
        ]);

        return $kinsman;
    }

    public function rules(): array
    {
        return [
            'employee_id'           =>  'required|numeric',
            'title'                 =>  'required|string',
            'first_name'            =>  'required|string',
            'last_name'             =>  'required|string',
            'middle_name'           =>  'nullable|string',
            'relation'              =>  'required|string',
            'occupation'            =>  'nullable|string',
            'organisation'          =>  'nullable|string',
            'contact_address'       =>  'required|string',
            'phone_number_1'        =>  'required|numeric',
            'phone_number_2'        =>  'nullable|numeric'
        ];
    }

    private function getKinsman($employeeId, $firstname, $lastname, $relation)
    {
        $record = Kinsman::where('employee_id', $employeeId)
            ->where('firstname', $firstname)
            ->where('lastname', $lastname)
            ->where('relation', $relation)
            ->first();

        if(empty($record)){
            $record = new Kinsman;
        }
        return $record;
    }

}
