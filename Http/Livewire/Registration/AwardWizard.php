<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Award;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Enums\WithEnums;

class AwardWizard extends LivewireUI
{
    use WithEnums;

    public Award $award;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
        $this->award = new Award();
    }

    public function render()
    {
        return view('employees::livewire.registration.award.index');
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
        Award::destroy($id);
        $this->browse();
        return $this->toastr('Award deleted');
    }

    public function save()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->award->staff()->associate($staff);
        $this->award->save();
        $this->resetFields();
        $this->toastr('Award saved');
    }

    public function rules()
    {
        return[
            'award.name' => 'required|string',
            'award.institution' => 'required|string',
            'award.country' => 'required|string',
            'award.year' => 'required|string',
        ];

    }

    public function resetFields()
    {
        $this->reset(['award']);
    }

    public function recovery()
    {
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $awards = $staff->awards()->get();
            $this->with('award', $awards);
        }else{
            $this->create();
        }
    }

    public function viewData()
    {
        $this->with('country', $this->country());
    }


}
