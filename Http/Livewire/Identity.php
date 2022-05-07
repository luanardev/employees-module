<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Storage;
use PDF;

class Identity extends LivewireUI
{
    use WithFileUploads;

    public Employee $employee;
    public $photo;
    public $signature;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function render()
    {
        return view("employees::livewire.identity");
    }

    public function save()
    {
        Gate::authorize('create_identity');

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
        $oldAvatar = $this->employee->avatar;
        $staffNo = $this->employee->id;
        $avatar     =   $this->photo->storePublicly("employees/{$staffNo}",'public');
        $this->employee->avatar = $avatar;
        if($this->employee->saveQuietly()){
            if(Storage::exists("public/".$oldAvatar)){
                Storage::delete("public/".$oldAvatar);
            }
            $this->browseMode()->emitRefresh()->toastr('Photo saved');
        }
    }

    private function saveSignature()
    {
        $oldSignature = $this->employee->signature;
        $staffNo = $this->employee->id;
        $signature  =   $this->signature->storePublicly("employees/{$staffNo}",'public');
        $this->employee->signature = $signature;
        if($this->employee->saveQuietly()){
            if(Storage::exists("public/".$oldSignature)){
                Storage::delete("public/".$oldSignature);
            }
            $this->browseMode()->emitRefresh()->toastr('Signature saved');
        }
    }


}
