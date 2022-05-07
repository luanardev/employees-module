<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Employee;
use PDF;

class EmployeeController extends Controller
{
  
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->authorize('view_employee');

        return view('employees::employee.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->authorize('create_employee');

        return view('employees::employee.create');
    }

    /**
     * Save and Reset employee form
     * @return Renderable
     */
    public function finish()
    {
        if(session()->exists('employee') ){
            session()->forget('employee');
            return redirect()->route('employee.create')->with('success', 'Operation successful');
        }else{
            return redirect()->route('employee.create');
        }
    }

    /**
     * Cancel employee form
     * @return Renderable
     */
    public function cancel()
    {
        if(session()->exists('employee') ){
            $employeeId = session()->get('employee');
            $employee = Employee::findorfail($employeeId);
            $employee->delete();
            session()->forget('employee');
            return redirect()->route('employee.create')->with('success', 'Operation cancelled');
        }else{
            return redirect()->route('employee.create');
        }

    }

    /**
     * Search a listing of the resource.
     * @return Renderable
     */
    public function search()
    {
        $this->authorize('view_employee');

        return view('employees::employee.search');
    }

    /**
     * Show the specified resource.
     * @param Employee $employee
     * @return Renderable
     */
    public function show(Employee $employee)
    { 
        $this->authorize('view_employee');

        return view('employees::employee.show')->with([
            'employee' => $employee
        ]);
    }


    /**
     * Delete the specified resource.
     * @param Employee $employee
     * @return Renderable
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete_employee');

        $employee->delete();

        if(session()->exists('employee') ){
            session()->forget('employee');
        }
        return redirect()->route('employee.index')->with('success', 'Employee removed from the system');
    }

    /**
     * Show the specified resource.
     * @param Employee $employee
     * @return Renderable
     */
    public function export(Employee $employee)
    {
        $this->authorize('view_employee');

        $name = Str::kebab($employee->name());

        $pdf = PDF::loadView('employees::employee.pdf', [
            'employee' => $employee
        ]);

        return $pdf->stream($name.'.pdf');
    }


}
