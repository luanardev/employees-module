<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Imports\DesignationImport;
use Maatwebsite\Excel\Validators\ValidationException;
use Livewire\WithFileUploads;
use Exception;

class DesignationConfig extends LivewireUI
{
    use WithFileUploads;

    public Designation $designation;

    public $importMode;

    public $importFile;

   
    public function __construct()
    {
        $this->designation = new Designation();
    }

    public function render()
    {
        return view('employees::livewire.settings.designation.index');
    }

    public function create()
    {
        $this->createMode();
    }

    public function import()
    {
        $this->importMode = true;
        $this->browseMode = false;
    }

    public function edit($id=null)
    {
        $this->designation = Designation::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
        $this->importMode = false;
    }

    public function delete($keys)
    {
        Designation::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Designation deleted');
    }

    public function save()
    {
        $this->validate();
        $this->designation->save();
        $this->browseMode()->emitRefresh()->toastr('Designation saved');
    }

    public function upload()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx|max:102400',
        ]);

        try{
            (new DesignationImport)->import($this->importFile);
            $this->importMode = false;
            return $this->browseMode()->emitRefresh()->toastr("Import successful");

        }catch(ValidationException | Exception $exception){
            if($exception instanceof ValidationException){
                return $this->toastrError( $exception->getMessage());
            }elseif($exception instanceof Exception){
                return $this->toastrError( $exception->getMessage());
            }

        }
    }


    public function rules()
    {
        return[
            'designation.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-designation'  => 'create',
            'edit-designation'    => 'edit',
            'delete-designation'  => 'delete',
        ];
    }

  
}
