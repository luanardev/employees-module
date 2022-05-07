<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Morphism;

trait WithSupervision
{

    public function supervise($employee)
    {
        if(!$employee instanceof Employee){
            $employee = Employee::findorfail($employee);
        }
        return $this->link($employee);
    }

    public function unsupervise($employee)
    {
        if(!$employee instanceof Employee){
            $employee = Employee::findorfail($employee);
        }
        return $this->unlink($employee);
    }

    public function reportTo($employee)
    {
        if(!$employee instanceof Employee){
            $employee = Employee::findorfail($employee);
        }
        return $this->inverselink($employee);
    }

    public function unreportTo($employee)
    {
        if(!$employee instanceof Employee){
            $employee = Employee::findorfail($employee);
        }
        return $this->inverseUnlink($employee);
    }

    public function supervisor()
    {
        return $this->hasOneThrough(Employee::class, Morphism::class, 'model_id', 'id', 'id', 'employee_id')
            ->where('model_type', Employee::class)
            ->withDefault();
    }

    public function subordinates()
    {
        return $this->hasManyThrough(Employee::class, Morphism::class, 'employee_id', 'id', 'id', 'model_id')
            ->where('model_type', Employee::class);
    }
}
