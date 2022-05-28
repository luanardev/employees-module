<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\HRSettings\Entities\QualificationLevel;
use Luanardev\Modules\Employees\Entities\Qualification;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Enums\WithEnums;

class QualificationWizard extends LivewireUI
{
    use WithEnums;

    public Qualification $qualification;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
        $this->qualification = new Qualification;
    }

    public function render()
    {
        return view('employees::livewire.registration.qualification.index');
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
        Qualification::destroy($id);
        $this->browse();
        return $this->toastr('Qualification deleted');
    }

    public function save()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->qualification->staff()->associate($staff);
        $this->qualification->save();
        $this->resetFields();
        $this->toastr('Qualification saved');
    }

    public function rules()
    {
        return[
            'qualification.name' => 'required|string',
            'qualification.level' => 'required',
            'qualification.specialization' => 'nullable|string',
            'qualification.institution' => 'required|string',
            'qualification.country' => 'required|string',
            'qualification.year' => 'required|string',
        ];

    }

    public function resetFields()
    {
        $this->reset(['qualification']);
    }

    public function recovery()
    {
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $qualifications = $staff->qualifications()->get();
            $this->with('qualification', $qualifications);
        }else{
            $this->create();
        }
    }

    public function viewData()
    {
        $this->with('country', $this->country());
        $this->with('level', QualificationLevel::pluck('id','name')->flip()->toArray());
    }


}
