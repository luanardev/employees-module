<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Staff;
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
    public function show(Staff $staff)
    {
        $this->authorize('view_staff_card');

        return view('employees::identity.show')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function card(Staff $staff)
    {
        $this->authorize('print_staff_card');
        
        $name = Str::kebab($staff->name());

        $pdf = PDF::loadView('employees::identity.card', [
            'staff' => $staff
        ]);

        $paper = array(0,0,324,204);
        $pdf->setPaper($paper);
        
        return $pdf->stream($name.'-id-card.pdf');
    }

}
