<?php

namespace Luanardev\Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Luanardev\Modules\Employees\Entities\Staff;
use PDF;

class StaffController extends Controller
{
  
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->authorize('view_staff');

        return view('employees::staff.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->authorize('create_staff');

        return view('employees::staff.create');
    }

    /**
     * Save and Reset staff form
     * @return Renderable
     */
    public function finish()
    {
        if(session()->exists('staff') ){
            session()->forget('staff');
            return redirect()->route('staff.create')->with('success', 'Operation successful');
        }else{
            return redirect()->route('staff.create');
        }
    }

    /**
     * Cancel staff form
     * @return Renderable
     */
    public function cancel()
    {
        if(session()->exists('staff') ){
            $staffId = session()->get('staff');
            $staff = Staff::findorfail($staffId);
            $staff->delete();
            session()->forget('staff');
            return redirect()->route('staff.create')->with('success', 'Operation cancelled');
        }else{
            return redirect()->route('staff.create');
        }

    }

    /**
     * Search a listing of the resource.
     * @return Renderable
     */
    public function search()
    {
        $this->authorize('view_staff');

        return view('employees::staff.search');
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function show(Staff $staff)
    { 
        $this->authorize('view_staff');

        return view('employees::staff.show')->with([
            'staff' => $staff
        ]);
    }


    /**
     * Delete the specified resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function destroy(Staff $staff)
    {
        $this->authorize('delete_staff');

        $staff->delete();

        if(session()->exists('staff') ){
            session()->forget('staff');
        }
        return redirect()->route('staff.index')->with('success', 'Staff removed from the system');
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     */
    public function export(Staff $staff)
    {
        $this->authorize('view_staff');

        $name = Str::kebab($staff->name());

        $pdf = PDF::loadView('employees::staff.pdf', [
            'staff' => $staff
        ]);

        return $pdf->stream($name.'.pdf');
    }


}
