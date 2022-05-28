<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Managership;

trait WithManagership
{

    public function getManager()
    {
        return $this->hasOneThrough(Staff::class, Managership::class, 'section_id', 'id', 'id', 'staff_id')
            ->where('position', 'Head')
            ->withDefault();
    }

    public function getDeputyManager()
    {
        return $this->hasOneThrough(Staff::class, Managership::class, 'section_id', 'id', 'id', 'staff_id')
            ->where('position', 'Deputy')
            ->withDefault();
    }

    public function isManager()
    {
        $managership = new Managership();
        return $managership->isManager($this);
    }

    public function isDeputyManager()
    {
        $managership = new Managership();
        return $managership->isDeputyManager($this);
    }

    public function hasManagership()
    {
        if($this->isManager() || $this->isDeputyManager()){
            return true;
        }else{
            return false;
        }
    }

}
