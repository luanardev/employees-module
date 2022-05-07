<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Kinsman;
use Luanardev\Modules\Employees\Entities\Employee;

class StaffKinsman extends StaffProfile
{

    public Kinsman $kinsman;

    public function mount(Employee $employee)
    {
        parent::mount($employee);
        $this->kinsman = new Kinsman();
    }

    public function render()
    {
        return view('employees::livewire.staff.kinsman.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function edit($id=null)
    {
        $this->kinsman = Kinsman::find($id);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($key)
    {
        Kinsman::destroy($key);
        $this->browseMode()->emitRefresh()->toastr('Next of Kin deleted');
    }

    public function save()
    {
        $this->validate();
        $this->kinsman->employee()->associate($this->employee);
        $this->kinsman->save();
        $this->browseMode()->emitRefresh()->toastr('Next of Kin saved');
    }

    public function rules()
    {
        return [
            'kinsman.title' => 'required|string',
            'kinsman.firstname' => 'required|string',
            'kinsman.lastname' => 'required|string',
            'kinsman.middlename' => 'nullable|string',
            'kinsman.relation' => 'required|string',
            'kinsman.occupation' => 'nullable|string',
            'kinsman.organisation' => 'nullable|string',
            'kinsman.contact_address' => 'required|string',
            'kinsman.phone1' => 'required|string',
            'kinsman.phone2' => 'nullable|string',
        ];

    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('relation', $this->family());
    }


}
