<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Institution\Entities\Faculty;
use Luanardev\Modules\Institution\Entities\Campus;

class Deanship extends Model
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
    protected $table = 'hrm_supervisor_faculty';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'faculty_id', 'campus_id', 'position'];

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
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * Assign deanship
     *
     * @param mixed $staff
     * @param mixed $faculty
     * @param mixed $campus
     * @param string $position
     * @return void
     */
    public function assign($staff, $faculty, $campus, $position)
    {
        $this->staff()->associate($staff);
        $this->faculty()->associate($faculty);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->save();
    }

    /**
     * @param mixed $staff
     * @return boolean
     */
    public function isDean($staff)
    {
        if($staff instanceof Staff){
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Dean')
            ->exists();
    }

    /**
     * @param mixed $staff
     * @return boolean
     */
    public function isDeputyDean($staff)
    {
        if($staff instanceof Staff){
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param mixed $faculty
     * @param mixed $campus
     * @return boolean
     */
    public function hasDean($faculty, $campus)
    {
        if($faculty instanceof Faculty){
            $faculty = $faculty->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->where('position', 'Dean')
            ->exists();
    }

    /**
     * @param mixed $faculty
     * @param mixed $campus
     * @return boolean
     */
    public function hasDeputyDean($faculty, $campus)
    {
        if($faculty instanceof Faculty){
            $faculty = $faculty->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param mixed $faculty
     * @param mixed $campus
     * @param mixed $position
     * @return boolean
     */
    public function isAssigned($faculty, $campus, $position)
    {
        if($faculty instanceof Faculty){
            $faculty = $faculty->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
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
        return ['Dean', 'Deputy'];
    }

}
