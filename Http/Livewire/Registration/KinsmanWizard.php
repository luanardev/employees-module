<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Kinsman;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Enums\WithEnums;

class KinsmanWizard extends LivewireUI
{
    use WithEnums;

    public Kinsman $kinsman;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
    }

    public function render()
    {
        $this->viewData();
        return view('employees::livewire.registration.kinsman.create');
    }

    public function copySpouse()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $staff = Staff::find(session()->get('staff'));
        if($staff->hasSpouse()){
            $this->kinsman->fill($staff->spouse()->getAttributes());
        }
    }

    public function resetSpouse()
    {
        $this->reset(['kinsman']);
    }

    public function save()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->kinsman->staff()->associate($staff);
        $this->kinsman->save();
        $this->toastr('Next of Kin saved');
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

    public function recovery()
    {
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $this->kinsman = $staff->kinsman;
        }else{
            $this->kinsman = new Kinsman();
        }

    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('relation', $this->family());
    }


}
