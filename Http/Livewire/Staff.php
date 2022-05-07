<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\Modules\Employees\Entities\Employee;
use Livewire\Component;

class Staff extends Component
{
    public Employee $employee;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }
    
    public function render()
    {
        return view('employees::livewire.staff');
    }
}
