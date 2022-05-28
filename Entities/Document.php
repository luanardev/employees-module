<?php

namespace Luanardev\Modules\Employees\Entities;
use Luanardev\Modules\Employees\Concerns\WithFinder;
use Luanardev\Modules\HRSettings\Entities\DocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Storage;

class Document extends Model
{
    use WithFinder;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_staff_documents';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'name', 'type', 'size', 'mime', 'path'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'type');
    }

	/**
     * @return string
     */
    public function getType()
    {
        return $this->documentType->name;
    }

    public function download($rootPath=null)
    {
        $path = $this->documentPath($rootPath);
        $name = $this->documentName();
        return Storage::download($path, $name);
    }

    public function documentPath($rootPath=null)
    {
        return $rootPath.DIRECTORY_SEPARATOR.$this->path;
    }

    public function documentName()
    {
        return Str::kebab($this->name.'.'.$this->mime);
    }

    public function readableSize()
    {
        return $this->formatBytes($this->size,0);
    }

    private function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}
