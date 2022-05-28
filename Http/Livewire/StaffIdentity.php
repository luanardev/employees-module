<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Storage;

class StaffIdentity extends LivewireUI
{
    use WithFileUploads;

    public Staff $staff;
    public $photo;
    public $signature;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        return view("employees::livewire.identity");
    }

    public function save()
    {

        $this->validate([
            'photo' => 'nullable:image|max:10240',
            'signature' => 'nullable:image|max:10240',
        ]);

        if(!empty($this->photo)){
            $this->saveAvatar();
        }
        elseif(!empty($this->signature)){
            $this->saveSignature();
        }
    }

    private function saveAvatar()
    {
        $oldAvatar = $this->staff->avatar;
        $staffNo = $this->staff->id;
        $avatar     =   $this->photo->storePublicly("employees/{$staffNo}",'public');
        $this->staff->avatar = $avatar;
        if($this->staff->saveQuietly()){
            if(Storage::exists("public/".$oldAvatar)){
                Storage::delete("public/".$oldAvatar);
            }
            $this->browseMode()->emitRefresh()->toastr('Photo saved');
        }
    }

    private function saveSignature()
    {
        $oldSignature = $this->staff->signature;
        $staffNo = $this->staff->id;
        $signature  =   $this->signature->storePublicly("employees/{$staffNo}",'public');
        $this->staff->signature = $signature;
        if($this->staff->saveQuietly()){
            if(Storage::exists("public/".$oldSignature)){
                Storage::delete("public/".$oldSignature);
            }
            $this->browseMode()->emitRefresh()->toastr('Signature saved');
        }
    }


}
