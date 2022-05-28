<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Staff;
use Luanardev\Modules\Employees\Http\Livewire\Livewire;
use Luanardev\Modules\Employees\Entities\Document;
use Luanardev\Modules\HRSettings\Entities\DocumentType;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Storage;
use ZipArchive;

class StaffDocument extends StaffProfile
{
    use WithFileUploads;

    public $name;
    public $type;
    public $file;

    public function render()
    {
        return view("employees::livewire.staff.document.index");
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($key)
    {
        Document::destroy($key);
        $this->browseMode()->emitRefresh()->toastr('Document deleted');
    }

    public function download($key)
    {
        if(count($key) > 1){
            return $this->zip($key);
        }else{
            $key = $key[0];
            $document = Document::find($key);
            return $document->download("public");
        }

    }

    public function zip($keys)
    {
        $name = Str::kebab($this->employee->name());
        $zip = new ZipArchive;
        $zipName = $name.'.zip';
        $zipPath = public_path($zipName);
        foreach($keys as $key){
            $document = Document::find($key);
            $filePath = $document->documentPath('storage');
            $fileName = $document->documentName();
            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                $zip->addFile($filePath, $fileName);
                $zip->close();
            }
        }
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf|max:20480',
        ]);

        $staffNo = $this->employee->id;
        $path = $this->file->storePublicly("employees/{$staffNo}",'public');

        $document = new Document;
        $document->employee()->associate($this->employee);
        $document->name = $this->name;
        $document->type = $this->type;
        $document->size = $this->file->getSize();
        $document->mime = $this->file->getClientOriginalExtension();
        $document->path = $path;
        $document->save();
        $this->browseMode()->emitRefresh()->toastr('Document saved');
    }

    public function getListeners()
    {
        return [
            'create-document'  => 'create',
            'delete-document'  => 'delete',
            'download-document'  => 'download'
        ];
    }

    public function viewData()
    {
        $this->with('documentType', DocumentType::pluck('id','name')->flip()->toArray());
    }

}
