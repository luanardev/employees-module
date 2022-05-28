<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Entities\Deanship;

trait WithDeanship
{

    public function getDean()
    {
        return $this->hasOneThrough(Staff::class, Deanship::class, 'faculty_id', 'id', 'id', 'staff_id')
            ->where('position', 'Dean')
            ->withDefault();
    }

    public function getDeputyDean()
    {
        return $this->hasOneThrough(Staff::class, Deaship::class, 'faculty_id', 'id', 'id', 'staff_id')
            ->where('position', 'Deputy')
            ->withDefault();
    }

    public function isDean()
    {
        $deanship = new Deanship();
        return $deanship->isDean($this);
    }

    public function isDeputyDean()
    {
        $deanship = new Deanship();
        return $deanship->isDeputyDean($this);
    }

    public function hasDeanship()
    {
        if($this->isDean() || $this->isDeputyDean()){
            return true;
        }else{
            return false;
        }
    }


}
