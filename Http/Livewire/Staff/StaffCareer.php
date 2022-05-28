<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Progress;


class StaffCareer extends StaffProfile
{

    public function render()
    {
        return view('employees::livewire.staff.career.index');
    }

    public function delete($id)
    {
        Progress::destroy($id);
        $this->emitRefresh()->toastr('Career deleted');
    }


}
