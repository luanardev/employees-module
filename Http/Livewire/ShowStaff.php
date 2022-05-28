<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff as Member;

class ShowStaff extends LivewireUI
{
    public Member $staff;

    public function mount(Member $staff)
    {
        $this->staff = $staff;
    }
    
    public function render()
    {
        return view('employees::livewire.staff');
    }
}
