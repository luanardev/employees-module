<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
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
    protected $table = 'hrm_supervisor_surbodinate';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['supervisor_id', 'subordinate_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisor()
    {
        return $this->belongsTo(Staff::class, 'supervisor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subordinate()
    {
        return $this->belongsTo(Staff::class, 'subordinate_id');
    }

    /**
     * Link Staff to Model in Polymorphic relationship
     *
     * @param Staff $supervisor
     * @param Staff $subordinate
     */
    public function link(Staff $supervisor, Staff $surbodinate)
    {
        $this->setAttribute('supervisor_id', $supervisor->getKey());
        $this->setAttribute('surbodinate_id',    $subordinate->getKey());
        return $this->save();
    }

    /**
     * UnLink Staff to Model in Polymorphic relationship
     *
     * @param Staff $supervisor
     * @param Staff $surbodinate
     */
    public function unlink(Staff $supervisor, Staff $surbodinate)
    {
        return static::where('supervisor_id', $supervisor->getKey())
                    ->where('surbodinate_id',    $surbodinate->getKey())
                    ->delete();
    }

     /**
     * Check whether Staff is Supervisor
     * @param Staff $staff
     * @return boolean
     */
    public function isSupervisor(Staff $staff)
    {
        return static::where('supervisor_id', $staff->getKey())->exists();
    }

    /**
     * Check whether Staff is Subordinate
     * @param Staff $staff
     * @return boolean
     */
    public function isSubordinate(Staff $staff)
    {
        return static::where('subordinate_id', $staff->getKey())->exists();
    }


}
