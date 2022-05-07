<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Reports\EmployeeFilter;
use Luanardev\Modules\Employees\Reports\EmployeeReport;

class ReportController extends Controller
{
    public function create()
    {
        $this->authorize('view_employee_report');

        $filter = new EmployeeFilter;
        
        return $filter->render('employees::report.create');
    }

    public function result(Request $request)
    {
        $this->authorize('view_employee_report');
        
        $report = new EmployeeReport;
        $report->setFilterBy( $request->get('filterby') );
        $report->setGroupBy( $request->get('groupby') );
        $report->setSortBy( $request->get('sortby') );
        return $report->render('employees::report.show');
    }

}
