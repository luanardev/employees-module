<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\Institution\Entities\Campus;

class Managership extends Model
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
    protected $table = 'hrm_supervisor_section';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'section_id', 'campus_id', 'position'];

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
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
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
     * @param mixed $section
     * @param mixed $campus
     * @param string $position
     * @return void
     */
    public function assign($staff, $section, $campus, $position)
    {
        $this->staff()->associate($staff);
        $this->section()->associate($section);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->save();
    }

    /**
     * @param mixed $staff
     * @return boolean
     */
    public function isManager($staff)
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
    public function isDeputyManager($staff)
    {
        if($staff instanceof Staff){
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param mixed $section
     * @param mixed $campus
     * @return boolean
     */
    public function hasManager($section, $campus)
    {
        if($section instanceof Section){
            $section = $section->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('section_id', $section)
            ->where('campus_id', $campus)
            ->where('position', 'Head')
            ->exists();
    }

    /**
     * @param mixed $section
     * @param mixed $campus
     * @return boolean
     */
    public function hasDeputyManager($section, $campus)
    {
        if($section instanceof Section){
            $section = $section->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('section_id', $section)
            ->where('campus_id', $campus)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param mixed $section
     * @param mixed $campus
     * @param mixed $position
     * @return boolean
     */
    public function isAssigned($section, $campus, $position)
    {
        if($section instanceof Section){
            $section = $section->getKey();
        }
        if($campus instanceof Campus){
            $campus = $campus->getKey();
        }
        return static::where('section_id', $section)
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
