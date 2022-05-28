<?php

namespace Luanardev\Modules\Employees\Facades;
use Illuminate\Support\Facades\Facade;

class StaffConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'staffconfig';
    }

}

