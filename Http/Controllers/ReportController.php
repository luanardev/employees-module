<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Reports\StaffFilter;
use Luanardev\Modules\Employees\Reports\StaffReport;

class ReportController extends Controller
{
    public function create()
    {
        $this->authorize('view_staff_report');

        $filter = new StaffFilter;
        
        return $filter->render('employees::report.create');
    }

    public function result(Request $request)
    {
        $this->authorize('view_staff_report');
        
        $report = new StaffReport;
        $report->setFilterBy( $request->get('filterby') );
        $report->setGroupBy( $request->get('groupby') );
        $report->setSortBy( $request->get('sortby') );
        return $report->render('employees::report.show');
    }

}
