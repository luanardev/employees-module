<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Grade;

class GradeConfig extends LivewireUI
{
    public Grade $grade;

    public function __construct()
    {
        $this->grade = new Grade();
    }

    public function render()
    {
        return view('employees::livewire.settings.grade.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($id=null)
    {
        $this->grade = Grade::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        Grade::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Grade deleted');
    }

    public function save()
    {
        $this->validate();
        $this->designation->save();
        $this->browseMode()->emitRefresh()->toastr('Grade saved');
    }

    public function rules()
    {
        return[
            'grade.grade' => 'required|string',
            'grade.gross_salary' => 'nullable|float',
            'grade.leave_days' => 'nullable|int',
        ];

    }

    public function getListeners()
    {
        return [
            'create-grade'  => 'create',
            'edit-grade'    => 'edit',
            'delete-grade'  => 'delete',
        ];
    }

  
}
