<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Entities\Staff;
use Livewire\WithFileUploads;

class StaffAvatar extends StaffProfile
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        return view("employees::livewire.staff.avatar.index");
    }

    public function show()
    {
        $this->browseMode();
    }

    public function create()
    {
        $this->createMode();
    }

    public function save()
    {
        if(empty($this->photo)){
            return;
        }
        $this->validate([
            'photo' => 'required|image|max:10240',
        ]);
        $staffNo = $this->staff->id;
        $path = $this->photo->storePublicly("employees/{$staffNo}",'public');
        $this->staff->avatar = $path;
        $this->staff->save();
        $this->browseMode()->emitRefresh()->toastr('Photo saved');
    }


}
