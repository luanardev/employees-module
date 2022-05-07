<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Concerns\WithFinder;

class EmploymentStatus extends Model
{
    use WithFinder;

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
    protected $table = 'hrm_employment_status';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    public static function getQuitingStatus()
    {
        $statuses = ['Retired','Resigned','Terminated', 'Dismissed', 'Deceased'];
        $statusKeys = static::whereIn('name', $statuses)->pluck('id')->toArray();
        return $statusKeys;
    }

    public static function getResumingStatus()
    {
        $statuses = ['Serving','Probation'];
        $statusKeys = static::whereIn('name', $statuses)->pluck('id')->toArray();
        return $statusKeys;
    }

}
