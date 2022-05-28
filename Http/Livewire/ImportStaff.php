<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Imports\staffImport;
use Maatwebsite\Excel\Validators\ValidationException;
use Livewire\WithFileUploads;
use Exception;


class ImportStaff extends LivewireUI
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view("employees::livewire.import");
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx|max:102400',
        ]);

        try{
            (new staffImport)->import($this->file);
            return $this->emitRefresh()->toastr("Import successful");

        }catch(ValidationException | Exception $exception){
            if($exception instanceof ValidationException){
                return $this->toastrError( $exception->getMessage());
            }elseif($exception instanceof Exception){
                return $this->toastrError( "Invalid Template");
            }

        }
    }

}
