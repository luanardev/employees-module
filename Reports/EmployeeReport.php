<?php

namespace Luanardev\Modules\Employees\Reports;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class EmployeeReport extends ReportBuilder
{

    public function columns(): array
    {
        return [
            'id',
            'title',
            'fullname',
            'gender',
            'designation',
            'appointment',
            'category',
            'status',
            'campus',
            'department',
            'section'
        ];
    }

    public function query(): Builder
    {
        $query = DB::table('hrm_employee_view') ->select("*");

        foreach($this->columns() as $column){
            $query->when($this->filter($column),
                fn ($query, $value) => $query->where($column, $value)
            );
        }
        return $query;
    }

}
