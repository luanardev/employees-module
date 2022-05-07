<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Employee;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->authorize('view_appointment');

        return view('employees::appointment.index');
    }

    /**
     * Search a listing of the resource.
     * @return Renderable
     */
    public function search()
    {
        $this->authorize('view_appointment');

        return view('employees::appointment.search');
    }

    /**
     * Show the form for creating a new resource.
     * @param Employee $employee
     * @return Renderable
     */
    public function create(Employee $employee)
    {
        $this->authorize('create_appointment');

        if($employee->employment->isAppointed()){
            return back()->with('error', "{$employee->name()} already serving an Appointment");
        }
        elseif($employee->employment->isNotPermanent()){
            return back()->with('error', "{$employee->name()} is not Permanent Staff ");
        }
        elseif($employee->employment->isNotConfirmed()){
            return back()->with('error', "{$employee->name()} is not Confirmed Staff ");
        }
        else{
            return view('employees::appointment.create')->with(['employee' => $employee]);
        }

    }

}
