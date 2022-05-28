<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Employment;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Employment;

class Confirmation extends LivewireUI
{
    public $confirmDate;
    public Staff $staff;
	public Employment $employment;

	public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->employment = $staff->employment;
    }

    public function render()
    {
        return view('employees::livewire.employment.confirmation');
    }

    public function save()
    {
        if($this->employment->isPermanent() && $this->employment->isNotConfirmed() ){
            $this->employment->confirmation($this->confirmDate);
            $this->emitRefresh()->toastr('Confirmation successful');
        }else{
            $this->emitRefresh()->toastrError('Staff already confirmed');
        }
    }


}
