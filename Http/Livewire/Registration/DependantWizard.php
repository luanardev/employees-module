<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Dependant;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Enums\WithEnums;

class DependantWizard extends LivewireUI
{
    use WithEnums;

    public Dependant $dependant;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
        $this->dependant = new Dependant;
    }

    public function render()
    {
        return view('employees::livewire.registration.dependant.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Dependant::destroy($id);
        $this->browse();
        return $this->toastr('Dependant deleted');
    }

    public function save()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->dependant->staff()->associate($staff);
        $this->dependant->save();
        $this->resetFields();
        return $this->toastr('Dependant saved');
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

    public function resetFields()
    {
        $this->reset(['dependant']);
    }

    public function recovery()
    {
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $dependants = $staff->dependants()->get();
            $this->with('dependant', $dependants);
        }else{
            $this->create();
        }
    }

    public function viewData()
    {
        $this->with('relation', $this->family());
        $this->with('gender', $this->gender());
        $this->with('title', $this->title());
    }


}
