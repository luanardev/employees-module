<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Staff;

class ManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->authorize('view_supervision');

        return view('employees::supervision.manager.index');
    }

    /**
     * Search a listing of the resource.
     * @return Renderable
     */
    public function search()
    {
        $this->authorize('create_supervision');

        return view('employees::supervision.manager.search');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function assign(Staff $staff)
    {
        $this->authorize('create_supervision');
        
        return view('employees::supervision.manager.assign')->with([
            'staff' => $staff
        ]);
    }

}
