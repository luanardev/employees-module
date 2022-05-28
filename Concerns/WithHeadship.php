<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Headship;

trait WithHeadship
{

    public function getHead()
    {
        return $this->hasOneThrough(Staff::class, Headship::class, 'department_id', 'id', 'id', 'staff_id')
            ->where('position', 'Head')
            ->withDefault();
    }

    public function getDeputyHead()
    {
        return $this->hasOneThrough(Staff::class, Headship::class, 'department_id', 'id', 'id', 'staff_id')
            ->where('position', 'Deputy')
            ->withDefault();
    }

    public function isHead()
    {
        $headship = new Headship();
        return $headship->isHead($this);
    }

    public function isDeputyHead()
    {
        $headship = new Headship();
        return $headship->isDeputyHead($this);
    }

    public function hasHeadship()
    {
        if($this->isHead() || $this->isDeputyHead()){
            return true;
        }else{
            return false;
        }
    }


}
