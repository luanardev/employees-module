<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\ProgressType;

class ProgressTypeConfig extends LivewireUI
{
    public ProgressType $progressType;

    public function __construct()
    {
        $this->progressType = new ProgressType();
    }

    public function render()
    {
        return view('employees::livewire.settings.progress-type.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($id=null)
    {
        $this->progressType = ProgressType::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        ProgressType::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Progress Type deleted');
    }

    public function save()
    {
        $this->validate();
        $this->progressType->save();
        $this->browseMode()->emitRefresh()->toastr('Progress Type saved');
    }

    public function rules()
    {
        return[
            'progressType.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-progress-type'  => 'create',
            'edit-progress-type'    => 'edit',
            'delete-progress-type'  => 'delete',
        ];
    }

  
}
