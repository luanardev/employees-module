<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;


class ImporterController extends Controller
{
    
    /**
     * Download template.
     * @return Renderable
     */
    public function template()
    {
        $this->authorize('create_employee');

        return Storage::download("temp/Staff_Record_Template.xlsx");
    }

    /**
     * Import Employee
     * @return Renderable
     */
    public function import()
    {
        $this->authorize('create_employee');
        
        return view('employees::employee.import');
    }

}
