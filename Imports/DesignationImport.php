<?php

namespace Luanardev\Modules\Employees\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Luanardev\Modules\Employees\Entities\Designation;

class DesignationImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;

    public function model(array $row)
    {
        $exists = Designation::recordExists($row['name']);
        if(!$exists){
            return Designation::create([
                'name'  =>  $row['name'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' =>  'required|string',
        ];
    }

}
