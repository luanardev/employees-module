<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Document;
use Storage;

class DocumentObserver
{
    
    /**
     * Handle the Document "deleted" event.
     *
     * @param  Document  $spouse
     * @return void
     */
    public function deleted(Document $document)
    {
        $path = $document->path;
        if(Storage::exists("public/".$path)){
            Storage::delete("public/".$path);
        }
    }

    
}
