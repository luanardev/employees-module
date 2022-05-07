<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Dependant;
use Luanardev\Modules\Employees\Entities\Employee;

class StaffDependant extends StaffProfile
{

    public Dependant $dependant;

    public function mount(Employee $employee)
    {
        parent::mount($employee);
        $this->dependant = new Dependant();
    }

    public function render()
    {
        return view('employees::livewire.staff.dependant.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function edit($id=null)
    {
        $this->dependant = Dependant::find($id);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        Dependant::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Dependant deleted');
    }

    public function save()
    {
        $this->validate();
        $this->dependant->employee()->associate($this->employee);
        $this->dependant->save();
        $this->browseMode()->emitRefresh()->toastr('Dependant saved');
    }

    public function rules()
    {
        return[
            'dependant.title' => 'required|string',
            'dependant.firstname' => 'required|string',
            'dependant.lastname' => 'required|string',
            'dependant.gender' => 'required|string',
            'dependant.date_of_birth' => 'required|date',
            'dependant.relation' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-dependant'  => 'create',
            'edit-dependant'    => 'edit',
            'delete-dependant'  => 'delete'
        ];
    }

    public function viewData()
    {
        $this->with('relation', $this->family());
        $this->with('gender', $this->gender());
        $this->with('title', $this->title());
    }


}
