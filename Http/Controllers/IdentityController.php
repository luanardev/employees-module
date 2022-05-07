<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Employee;
use PDF;

class IdentityController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search()
    {
        $this->authorize('view_staff_card');

        return view('employees::identity.search');
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function show(Employee $employee)
    {
        $this->authorize('view_staff_card');

        return view('employees::identity.show')->with([
            'employee' => $employee
        ]);
    }

    /**
     * Show the specified resource.
     * @param Employee $employee
     * @return Renderable
     */
    public function card(Employee $employee)
    {
        $this->authorize('print_staff_card');
        
        $name = Str::kebab($employee->name());

        $pdf = PDF::loadView('employees::identity.card', [
            'employee' => $employee
        ]);

        $paper = array(0,0,324,204);
        $pdf->setPaper($paper);
        
        return $pdf->stream($name.'-id-card.pdf');
    }

}
