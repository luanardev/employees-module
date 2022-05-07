<?php

namespace Luanardev\Modules\Employees\Facades;
use Illuminate\Support\Facades\Facade;

class EmployeeSettings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'employeesettings';
    }

}

