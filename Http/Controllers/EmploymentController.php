<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Employee;

class EmploymentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @param Employee $employee
     * @return Renderable
     */
    public function contract(Employee $employee)
    {
        $this->authorize('update_employment');

        return view('employees::employee.contract')->with([
            'employee' => $employee
        ]);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function promote(Employee $employee)
    {
        $this->authorize('update_employment');

        if($employee->employment->isAppointed()){
            return back()->with('error', "{$employee->name()} is serving an appointment");
        }
        elseif($employee->employment->isNotPermanent()){
            return back()->with('error', "{$employee->name()} is not Permanent Staff ");
        }
        elseif($employee->employment->isNotConfirmed()){
            return back()->with('error', "{$employee->name()} is not Confirmed Staff ");
        }
        else{
            return view('employees::employee.promote')->with(['employee' => $employee]);
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function confirm(Employee $employee)
    {  
        $this->authorize('update_employment');

        return view('employees::employee.confirm')->with(['employee' => $employee]);
    }


}
