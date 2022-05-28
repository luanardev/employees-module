<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Staff;

class EmploymentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function promotion()
    {
        $this->authorize('update_employment');

        return view('employees::employment.promotion');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function confirmation()
    {
        $this->authorize('update_employment');

        return view('employees::employment.confirmation');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function contractRenewal()
    {
        $this->authorize('update_employment');

        return view('employees::employment.renewcontract');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function contract(Staff $staff)
    {
        $this->authorize('update_employment');

        return view('employees::employment.contract')->with([
            'staff' => $staff
        ]);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function promote(Staff $staff)
    {
        $this->authorize('update_employment');

        if($staff->employment->isAppointed()){
            return back()->with('error', "{$staff->name()} is serving an appointment");
        }
        elseif($staff->employment->isNotPermanent()){
            return back()->with('error', "{$staff->name()} is not Permanent Staff ");
        }
        elseif($staff->employment->isNotConfirmed()){
            return back()->with('error', "{$staff->name()} is not Confirmed Staff ");
        }
        else{
            return view('employees::employment.promote')->with(['staff' => $staff]);
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function confirm(Staff $staff)
    {  
        $this->authorize('update_employment');

        return view('employees::employment.confirm')->with(['staff' => $staff]);
    }


}
