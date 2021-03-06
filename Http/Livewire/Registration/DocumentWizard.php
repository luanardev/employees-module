<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Registration;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Document;
use Luanardev\Modules\Employees\Enums\WithEnums;
use Luanardev\Modules\HRSettings\Entities\DocumentType;
use Livewire\WithFileUploads;

class DocumentWizard extends LivewireUI
{
    use WithFileUploads;
    use WithEnums;

    public $name;
    public $type;
    public $file;

    public function __construct()
    {
        parent::__construct();
        $this->recovery();
    }

    public function render()
    {
        return view("employees::livewire.registration.document.index");
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Document::destroy($id);
        $this->browse();
        return $this->toastr('Document deleted');
    }

    public function save()
    {
        if(!session()->exists('staff')){
            return false;
        }

        $this->validate();

        $staff = Staff::find(session()->get('staff'));
        $path = $this->file->storePublicly("employees/{$staff->id}",'public');

        $document = new Document;
        $document->staff()->associate($staff);
        $document->name = $this->name;
        $document->type = $this->type;
        $document->size = $this->file->getSize();
        $document->mime = $this->file->getClientOriginalExtension();
        $document->path = $path;
        $document->save();
        $this->resetFields();
        $this->toastr('Document saved');
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf|max:20480'
        ];
    }

    public function resetFields()
    {
        $this->reset([
            'name',
            'type',
            'file',
        ]);
    }

    public function recovery()
    {
        if(session()->exists('staff')){
            $staff = Staff::find(session()->get('staff'));
            $documents = $staff->documents()->get();
            $this->with('document', $documents);
        }else{
            $this->create();
        }
    }

    public function viewData()
    {
        $this->with('documentType', DocumentType::pluck('id','name')->flip()->toArray());
    }
}
