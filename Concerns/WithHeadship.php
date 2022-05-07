<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Morphism;
use Luanardev\Modules\Institution\Entities\Faculty;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;

trait WithHeadship
{

    public function setHead($department)
    {
        if(!$department instanceof Depertment){
            $department = Department::findorfail($department);
        }
        return $this->link($department);
    }

    public function setDean($faculty)
    {
        if(!$faculty instanceof Faculty){
            $faculty = Faculty::findorfail($faculty);
        }
        return $this->link($faculty);
    }

    public function setManager($section)
    {
        if(!$section instanceof Section){
            $section = Section::findorfail($section);
        }
        return $this->link($section);
    }

    public function head()
    {
        return $this->hasOneThrough(Employee::class, Morphism::class, 'model_id', 'id', 'id', 'employee_id')
            ->where('model_type', Department::class)
            ->withDefault();
    }

    public function dean()
    {
        return $this->hasOneThrough(Employee::class, Morphism::class, 'model_id', 'id', 'id', 'employee_id')
            ->where('model_type', Faculty::class)
            ->withDefault();
    }

    public function manager()
    {
        return $this->hasOneThrough(Employee::class, Morphism::class, 'model_id', 'id', 'id', 'employee_id')
            ->where('model_type', Section::class)
            ->withDefault();
    }

}
