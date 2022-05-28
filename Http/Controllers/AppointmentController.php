<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Staff;

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
    public function add()
    {
        $this->authorize('view_appointment');

        return view('employees::appointment.add');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function create(Staff $staff)
    {
        $this->authorize('create_appointment');

        if($staff->employment->isAppointed()){
            return back()->with('error', "{$staff->name()} already serving an Appointment");
        }
        elseif($staff->employment->isNotPermanent()){
            return back()->with('error', "{$staff->name()} is not Permanent Staff ");
        }
        elseif($staff->employment->isNotConfirmed()){
            return back()->with('error', "{$staff->name()} is not Confirmed Staff ");
        }
        else{
            return view('employees::appointment.create')->with(['staff' => $staff]);
        }

    }

}
