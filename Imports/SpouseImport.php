<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Spouse;
use Luanardev\Modules\Employees\Concerns\WithExcelDate;

class SpouseImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    use WithExcelDate;

    public function model(array $row)
    {
        $spouse = $this->getSpouse(
            $row['employee_id'],
            $row['first_name'],
            $row['last_name']
        );

        $spouse->fill([
            'employee_id'       =>  $row['employee_id'],
            'title'             =>  $row['title'],
            'firstname'         =>  $row['first_name'],
            'lastname'          =>  $row['last_name'],
            'middlename'        =>  $row['middle_name'],
            'date_of_birth'     =>  $this->transformDate($row['date_of_birth']),
            'gender'            =>  $row['gender'],
            'contact_address'   =>  $row['contact_address'],
            'phone1'     		=>  $row['phone_number_1'],
            'phone2'     		=>  $row['phone_number_2'],
            'nationality'       =>  $row['nationality'],
            'residence_country' =>  $row['residence_country'],
            'home_village'      =>  $row['home_village'],
            'home_authority'    =>  $row['traditional_authority'],
            'home_district'     =>  $row['home_district']
        ]);

        return $spouse;
    }

    public function rules(): array
    {
        return [
            'employee_id'           =>  'required|numeric',
            'title'                 =>  'required|string',
            'first_name'            =>  'required|string',
            'last_name'             =>  'required|string',
            'middle_name'           =>  'nullable|string',
            'date_of_birth'         =>  'required',
            'gender'                =>  'required|string',
            'contact_address'       =>  'required|string',
            'phone_number_1'        =>  'required|numeric',
            'phone_number_2'        =>  'nullable|numeric',
            'nationality'           =>  'required|string',
            'residence_country'     =>  'required|string',
            'home_village'          =>  'required|string',
            'traditional_authority' =>  'required|string',
            'home_district'         =>  'required|string'
        ];
    }

    private function getSpouse($employeeId, $firstname, $lastname)
    {
        $record = Spouse::where('employee_id',$employeeId)
                ->where('firstname', $firstname)
                ->where('lastname', $lastname)
                ->first();

        if(empty($record)){
            $record = new Spouse;
        }
        return $record;
    }


}
