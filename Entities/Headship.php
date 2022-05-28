<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Campus;

class Headship extends Model
{
    /** 
     * Disable timestamp
     * var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_supervisor_department';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'department_id', 'campus_id', 'position'];

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
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * Assign headship
     *
     * @param mixed $staff
     * @param mixed $department
     * @param mixed $campus
     * @param string $position
     * @return void
     */
    public function assign($staff, $department, $campus, $position)
    {
        $this->staff()->associate($staff);
        $this->department()->associate($department);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->save();
    }

    /**
     * @param mixed $staff
     * @return boolean
     */
    public function isHead($staff)
    {
        if($staff instanceof Staff){
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Head')
            ->exists();
    }

    /**
     * @param mixed $staff
     * @return boolean
     */
    public function isDeputyHead($staff)
    {
        if($staff instanceof Staff){
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param mixed $department
     * @param mixed $campus
     * @return boolean
     */
    public function hasHead($department, $campus)
    {
        if($department instanceof Department){
            $department = $department->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', 'Head')
            ->exists();
    }

    /**
     * @param mixed $department
     * @param mixed $campus
     * @return boolean
     */
    public function hasDeputyHead($department, $campus)
    {
        if($department instanceof Department){
            $department = $department->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param mixed $department
     * @param mixed $campus
     * @param mixed $position
     * @return boolean
     */
    public function isAssigned($department, $campus, $position)
    {
        if($department instanceof Department){
            $department = $department->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', $position)
            ->exists();
    }

    /**
     *
     * @param mixed $staffID
     * @return self
     */
    public static function getStaff($staffID)
    {
        return static::where('staff_id', $staffID)->first();
    }

    /**
     * @return array
     */
    public static function positions()
    {
        return ['Head', 'Deputy'];
    }

}
