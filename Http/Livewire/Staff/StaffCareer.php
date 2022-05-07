<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Grade;
use Luanardev\Modules\Employees\Entities\Notch;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\ProgressType;


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
