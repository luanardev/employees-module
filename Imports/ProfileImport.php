<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Concerns\WithExcelDate;

class ProfileImport implements ToModel,  WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    use WithExcelDate;

    public function model(array $row)
    {
        $employee = $this->getEmployee(
            $row['employee_id'],
            $row['personal_email']
        );

        $employee->fill([
            'id'                =>  $row['employee_id'],
            'national_id'       =>  $row['national_id'],
            'title'             =>  $row['title'],
            'firstname'         =>  $row['first_name'],
            'lastname'          =>  $row['last_name'],
            'middlename'        =>  $row['middle_name'],
            'date_of_birth'     =>  $this->transformDate($row['date_of_birth']),
            'gender'            =>  $row['gender'],
            'marital_status'    =>  $row['marital_status'],
            'official_email'    =>  $row['official_email'],
            'personal_email'    =>  $row['personal_email'],
            'contact_address'   =>  $row['contact_address'],
            'phone1'     		=>  $row['phone_number_1'],
            'phone2'     		=>  $row['phone_number_2'],
            'nationality'       =>  $row['nationality'],
            'residence_country' =>  $row['residence_country'],
            'home_village'      =>  $row['home_village'],
            'home_authority'    =>  $row['traditional_authority'],
            'home_district'     =>  $row['home_district']
        ]);

        return $employee;
    }

    public function rules(): array
    {
        return [
            'id'                    =>  'nullable|numeric',
            'national_id'           =>  'required|string',
            'title'                 =>  'required|string',
            'first_name'            =>  'required|string',
            'last_name'             =>  'required|string',
            'middle_name'           =>  'nullable|string',
            'date_of_birth'         =>  'required',
            'gender'                =>  'required|string',
            'marital_status'        =>  'required|string',
            'official_email'        =>  'nullable|string',
            'personal_email'        =>  'required|string',
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

    private function getEmployee($employeeId, $email)
    {
        $record = Employee::where('id',$employeeId)
                ->where('personal_email', $email)
                ->first();

        if(empty($record)){
            $record = new Employee;
        }
        return $record;
    }

  
}
